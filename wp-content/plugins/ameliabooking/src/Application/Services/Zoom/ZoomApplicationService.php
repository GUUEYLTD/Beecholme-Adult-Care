<?php
/**
 * @copyright © TMS-Plugins. All rights reserved.
 * @licence   See LICENCE.md for license details.
 */

namespace AmeliaBooking\Application\Services\Zoom;

use AmeliaBooking\Application\Services\Placeholder\PlaceholderService;
use AmeliaBooking\Domain\Collection\Collection;
use AmeliaBooking\Domain\Entity\Booking\Appointment\Appointment;
use AmeliaBooking\Domain\Entity\Booking\Event\Event;
use AmeliaBooking\Domain\Entity\Booking\Event\EventPeriod;
use AmeliaBooking\Domain\Services\DateTime\DateTimeService;
use AmeliaBooking\Infrastructure\Repository\AbstractRepository;
use AmeliaBooking\Infrastructure\Repository\Booking\Event\EventPeriodsRepository;
use AmeliaBooking\Infrastructure\WP\EventListeners\Booking\Event\EventAddedEventHandler;
use AmeliaBooking\Infrastructure\WP\EventListeners\Booking\Event\EventEditedEventHandler;
use AmeliaBooking\Infrastructure\WP\EventListeners\Booking\Event\EventStatusUpdatedEventHandler;
use AmeliaBooking\Domain\Factory\Zoom\ZoomFactory;
use AmeliaBooking\Domain\Services\Settings\SettingsService;
use AmeliaBooking\Domain\ValueObjects\String\BookingStatus;
use AmeliaBooking\Infrastructure\Common\Container;
use AmeliaBooking\Infrastructure\Repository\Booking\Appointment\AppointmentRepository;
use AmeliaBooking\Infrastructure\WP\EventListeners\Booking\Appointment\AppointmentAddedEventHandler;
use AmeliaBooking\Infrastructure\WP\EventListeners\Booking\Appointment\AppointmentDeletedEventHandler;
use AmeliaBooking\Infrastructure\WP\EventListeners\Booking\Appointment\AppointmentEditedEventHandler;
use AmeliaBooking\Infrastructure\WP\EventListeners\Booking\Appointment\AppointmentStatusUpdatedEventHandler;
use AmeliaBooking\Infrastructure\WP\EventListeners\Booking\Appointment\AppointmentTimeUpdatedEventHandler;
use AmeliaBooking\Infrastructure\WP\EventListeners\Booking\Appointment\BookingAddedEventHandler;
use AmeliaBooking\Infrastructure\WP\EventListeners\Booking\Appointment\BookingCanceledEventHandler;
use AmeliaBooking\Infrastructure\Services\Zoom\ZoomService;
use \DateTimeZone;

/**
 * Class ZoomApplicationService
 *
 * @package AmeliaBooking\Application\Services\Zoom
 */
class ZoomApplicationService
{
    /** @var Container $container */
    private $container;

    const SCHEDULED_MEETING = 2;

    const RECURRING_WITH_FIXED_TIME_MEETING = 8;

    /**
     * ZoomApplicationService constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param Appointment $reservation
     * @param string $commandSlug
     *
     * @return void
     *
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\NotFoundException
     */
    public function handleAppointmentMeeting($reservation, $commandSlug)
    {
        /** @var AppointmentRepository $appointmentRepository */
        $appointmentRepository = $this->container->get("domain.booking.appointment.repository");

        /** @var SettingsService $settingsService */
        $settingsService = $this->container->get('domain.settings.service');

        $zoomEnabled = $settingsService
            ->getEntitySettings($reservation->getService()->getSettings())
            ->getZoomSettings()
            ->getEnabled();

        $zoomSettings = $settingsService->getCategorySettings('zoom');

        $zoomMeetingAllowed = $reservation->getStatus()->getValue() === BookingStatus::APPROVED ||
            (
                $reservation->getStatus()->getValue() === BookingStatus::PENDING &&
                $zoomSettings['pendingAppointmentsMeetings']
            );

        if ($zoomSettings['apiKey'] &&
            $zoomSettings['apiSecret'] &&
            $reservation->getProvider()->getZoomUserId() &&
            $zoomEnabled
        ) {
            switch ($commandSlug) {
                case AppointmentDeletedEventHandler::APPOINTMENT_DELETED:
                    if ($reservation->getZoomMeeting()) {
                        $this->removeMeeting($reservation, $appointmentRepository);
                    }
                    break;

                case AppointmentEditedEventHandler::APPOINTMENT_EDITED:
                case BookingAddedEventHandler::BOOKING_ADDED:
                    if (!$reservation->getZoomMeeting() && $zoomMeetingAllowed) {
                        $this->createOrEditAppointmentMeeting($reservation);
                    }
                    break;

                case AppointmentAddedEventHandler::APPOINTMENT_ADDED:
                case AppointmentTimeUpdatedEventHandler::TIME_UPDATED:
                case AppointmentEditedEventHandler::TIME_UPDATED:
                    if ($zoomMeetingAllowed) {
                        $this->createOrEditAppointmentMeeting($reservation);
                    }
                    break;

                case AppointmentStatusUpdatedEventHandler::APPOINTMENT_STATUS_UPDATED:
                case AppointmentEditedEventHandler::BOOKING_STATUS_UPDATED:
                case BookingCanceledEventHandler::BOOKING_CANCELED:
                    $this->processMeetingForStatusChange($reservation, false);
                    break;

                case AppointmentEditedEventHandler::APPOINTMENT_STATUS_AND_TIME_UPDATED:
                    $this->processMeetingForStatusChange($reservation, true);
                    break;
            }

            if ($reservation->getZoomMeeting() &&
                $reservation->getZoomMeeting()->getId() &&
                (!$reservation->getZoomMeeting()->getStartUrl() || !$reservation->getZoomMeeting()->getStartUrl())
            ) {
                /** @var AppointmentRepository $appointmentRepository */
                $appointmentRepository = $this->container->get("domain.booking.appointment.repository");

                $this->getMeeting($reservation);

                $appointmentRepository->updateFieldById(
                    $reservation->getId()->getValue(),
                    json_encode($reservation->getZoomMeeting()->toArray()),
                    'zoomMeeting'
                );
            }
        }
    }

    /**
     * @param Event      $reservation
     * @param Collection $periods
     * @param string     $commandSlug
     *
     * @return void
     *
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\NotFoundException
     */
    public function handleEventMeeting($reservation, $periods, $commandSlug)
    {
        /** @var SettingsService $settingsService */
        $settingsService = $this->container->get('domain.settings.service');

        $zoomSettings = $settingsService->getCategorySettings('zoom');

        /** @var EventPeriodsRepository $eventPeriodsRepository */
        $eventPeriodsRepository = $this->container->get('domain.booking.event.period.repository');

        if ($zoomSettings['apiKey'] && $zoomSettings['apiSecret'] && $reservation->getZoomUserId()) {
            switch ($commandSlug) {
                case EventEditedEventHandler::EVENT_ADDED:
                case EventAddedEventHandler::EVENT_ADDED:
                case EventEditedEventHandler::TIME_UPDATED:
                case EventEditedEventHandler::EVENT_PERIOD_ADDED:
                    $this->createOrEditEventMeeting($reservation, $periods);

                    break;

                case EventStatusUpdatedEventHandler::EVENT_STATUS_UPDATED:
                case EventEditedEventHandler::ZOOM_USER_ADDED:
                    if ($reservation->getStatus()->getValue() === BookingStatus::APPROVED) {
                        $this->createOrEditEventMeeting($reservation, $periods);
                    } elseif ($reservation->getStatus()->getValue() === BookingStatus::CANCELED ||
                        $reservation->getStatus()->getValue() === BookingStatus::REJECTED
                    ) {
                        /** @var EventPeriod $period */
                        foreach ($periods->getItems() as $period) {
                            $this->removeMeeting($period, $eventPeriodsRepository);
                        }
                    }

                    break;

                case EventEditedEventHandler::EVENT_DELETED:
                case EventEditedEventHandler::EVENT_PERIOD_DELETED:
                    /** @var EventPeriod $period */
                    foreach ($periods->getItems() as $period) {
                        $this->removeMeeting($period, $eventPeriodsRepository);
                    }
                    break;
            }

            /** @var EventPeriod $period */
            foreach ($periods->getItems() as $period) {
                if ($period->getZoomMeeting() &&
                    $period->getZoomMeeting()->getId() &&
                    (!$period->getZoomMeeting()->getStartUrl() || !$period->getZoomMeeting()->getStartUrl())
                ) {
                    /** @var EventPeriodsRepository $eventPeriodsRepository */
                    $eventPeriodsRepository = $this->container->get('domain.booking.event.period.repository');

                    $this->getMeeting($period);

                    $eventPeriodsRepository->updateFieldById(
                        $period->getId()->getValue(),
                        json_encode($period->getZoomMeeting()->toArray()),
                        'zoomMeeting'
                    );
                }
            }
        }
    }

    /**
     * @param Appointment $reservation
     * @param bool $timeUpdated
     *
     * @return void
     *
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\NotFoundException
     */
    private function processMeetingForStatusChange($reservation, $timeUpdated)
    {
        /** @var AppointmentRepository $appointmentRepository */
        $appointmentRepository = $this->container->get("domain.booking.appointment.repository");

        /** @var SettingsService $settingsService */
        $settingsService = $this->container->get('domain.settings.service');

        $zoomSettings = $settingsService->getCategorySettings('zoom');

        switch ($reservation->getStatus()->getValue()) {
            case BookingStatus::REJECTED:
            case BookingStatus::CANCELED:
                if ($reservation->getZoomMeeting()) {
                    $this->removeMeeting($reservation, $appointmentRepository);
                }
                break;

            case BookingStatus::APPROVED:
                if (!$reservation->getZoomMeeting() || $timeUpdated) {
                    $this->createOrEditAppointmentMeeting($reservation);
                }
                break;

            case BookingStatus::PENDING:
                if ($zoomSettings['pendingAppointmentsMeetings'] && (!$reservation->getZoomMeeting() || $timeUpdated)) {
                    $this->createOrEditAppointmentMeeting($reservation);
                } elseif (!$zoomSettings['pendingAppointmentsMeetings'] && $reservation->getZoomMeeting()) {
                    $this->removeMeeting($reservation, $appointmentRepository);
                }
                break;
        }
    }

    /**
     * @param Appointment|EventPeriod $reservation
     * @param AbstractRepository      $repository
     *
     * @return void
     *
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException
     */
    public function removeMeeting($reservation, $repository)
    {
        /** @var ZoomService $zoomService */
        $zoomService = $this->container->get('infrastructure.zoom.service');

        if ($reservation->getZoomMeeting() && $reservation->getZoomMeeting()->getId()) {
            $zoomService->deleteMeeting(
                $reservation->getZoomMeeting()->getId()->getValue()
            );

            $reservation->setZoomMeeting(ZoomFactory::create([]));

            $repository->updateFieldById(
                $reservation->getId()->getValue(),
                null,
                'zoomMeeting'
            );
        }
    }

    /**
     * @param Appointment|EventPeriod $reservation
     *
     * @return void
     *
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     */
    private function getMeeting($reservation)
    {
        /** @var ZoomService $zoomService */
        $zoomService = $this->container->get('infrastructure.zoom.service');

        $zoomResult = $zoomService->getMeeting($reservation->getZoomMeeting()->getId()->getValue());

        if (isset($zoomResult['id'], $zoomResult['join_url'], $zoomResult['start_url'])) {
            $reservation->setZoomMeeting(
                ZoomFactory::create(
                    [
                        'id'       => $zoomResult['id'],
                        'joinUrl'  => $zoomResult['join_url'],
                        'startUrl' => $zoomResult['start_url'],
                    ]
                )
            );
        }
    }

    /**
     * @param Appointment $reservation
     *
     * @return void
     *
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\NotFoundException
     */
    private function createOrEditAppointmentMeeting($reservation)
    {
        /** @var ZoomService $zoomService */
        $zoomService = $this->container->get('infrastructure.zoom.service');

        $meetingStart = DateTimeService::getCustomDateTimeObject(
            $reservation->getBookingStart()->getValue()->format('Y-m-d H:i:s')
        );

        $meetingEnd = DateTimeService::getCustomDateTimeObject(
            $reservation->getBookingEnd()->getValue()->format('Y-m-d H:i:s')
        );

        $meetingData = $this->getMeetingData(
            $reservation,
            self::SCHEDULED_MEETING,
            $meetingStart,
            $meetingEnd,
            ($meetingEnd->setTimezone(new DateTimeZone('UTC'))->getTimestamp() -
                $meetingStart->setTimezone(new DateTimeZone('UTC'))->getTimestamp()
            ) / 60
        );

        if ($reservation->getZoomMeeting() && $reservation->getZoomMeeting()->getId()) {
            $zoomService->updateMeeting(
                $reservation->getZoomMeeting()->getId()->getValue(),
                $meetingData
            );
        } else {
            $zoomResult = $zoomService->createMeeting(
                $reservation->getProvider()->getZoomUserId()->getValue(),
                $meetingData
            );

            if (isset($zoomResult['id'], $zoomResult['join_url'], $zoomResult['start_url'])) {
                /** @var AppointmentRepository $appointmentRepository */
                $appointmentRepository = $this->container->get("domain.booking.appointment.repository");

                $reservation->setZoomMeeting(
                    ZoomFactory::create(
                        [
                            'id'       => $zoomResult['id'],
                            'joinUrl'  => $zoomResult['join_url'],
                            'startUrl' => $zoomResult['start_url'],
                        ]
                    )
                );

                $appointmentRepository->updateFieldById(
                    $reservation->getId()->getValue(),
                    json_encode($reservation->getZoomMeeting()->toArray()),
                    'zoomMeeting'
                );
            }
        }
    }

    /**
     * @param Event      $reservation
     * @param Collection $periods
     *
     * @return void
     *
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\NotFoundException
     */
    private function createOrEditEventMeeting($reservation, $periods)
    {
        /** @var ZoomService $zoomService */
        $zoomService = $this->container->get('infrastructure.zoom.service');

        /** @var EventPeriodsRepository $eventPeriodsRepository */
        $eventPeriodsRepository = $this->container->get('domain.booking.event.period.repository');

        $eventPeriodsRepository->beginTransaction();

        /** @var EventPeriod $period */
        foreach ($periods->getItems() as $period) {
            $periodStartDateString = $period->getPeriodStart()->getValue()->format('Y-m-d');

            $periodEndDateString = $period->getPeriodEnd()->getValue()->format('Y-m-d');

            $periodStartTimeString = $period->getPeriodStart()->getValue()->format('H:i:s');

            $periodEndTimeString = $period->getPeriodEnd()->getValue()->format('H:i:s');

            $meetingStart = DateTimeService::getCustomDateTimeObject(
                $periodStartDateString . ' ' . $periodStartTimeString
            );

            $meetingEnd = DateTimeService::getCustomDateTimeObject(
                $periodStartDateString . ' ' . $periodEndTimeString
            );

            $meetingData = $this->getMeetingData(
                $reservation,
                $periodStartDateString === $periodEndDateString ?
                    self::SCHEDULED_MEETING : self::RECURRING_WITH_FIXED_TIME_MEETING,
                $meetingStart,
                DateTimeService::getCustomDateTimeObject(
                    $periodEndDateString . ' ' . $periodEndTimeString
                ),
                ($meetingEnd->setTimezone(new DateTimeZone('UTC'))->getTimestamp() -
                    $meetingStart->setTimezone(new DateTimeZone('UTC'))->getTimestamp()
                ) / 60
            );

            if ($period->getZoomMeeting()) {
                $zoomService->updateMeeting(
                    $period->getZoomMeeting()->getId()->getValue(),
                    $meetingData
                );
            } else {
                $zoomResult = $zoomService->createMeeting(
                    $reservation->getZoomUserId()->getValue(),
                    $meetingData
                );

                if (isset($zoomResult['id'], $zoomResult['join_url'], $zoomResult['start_url'])) {
                    $period->setZoomMeeting(
                        ZoomFactory::create(
                            [
                                'id'       => $zoomResult['id'],
                                'joinUrl'  => $zoomResult['join_url'],
                                'startUrl' => $zoomResult['start_url'],
                            ]
                        )
                    );

                    $eventPeriodsRepository->updateFieldById(
                        $period->getId()->getValue(),
                        json_encode($period->getZoomMeeting()->toArray()),
                        'zoomMeeting'
                    );
                }
            }
        }

        $eventPeriodsRepository->commit();
    }

    /**
     * @param Appointment|Event $reservation
     * @param int               $type
     * @param \DateTime         $meetingStart
     * @param \DateTime         $meetingEnd
     * @param int               $duration
     *
     * @return array
     *
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\NotFoundException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \Exception
     */
    private function getMeetingData($reservation, $type, $meetingStart, $meetingEnd, $duration)
    {
        /** @var SettingsService $settingsService */
        $settingsService = $this->container->get('domain.settings.service');

        /** @var PlaceholderService $placeholderService */
        $placeholderService = $this->container->get('application.placeholder.' . $reservation->getType()->getValue() .  '.service');

        $zoomSettings = $settingsService->getCategorySettings('zoom');

        $placeholderData = $placeholderService->getPlaceholdersData($reservation->toArray());

        $meetingData = [
            'topic'      => $placeholderService->applyPlaceholders(
                $zoomSettings['meetingTitle'],
                $placeholderData
            ),
            'agenda'      => $placeholderService->applyPlaceholders(
                $zoomSettings['meetingAgenda'],
                $placeholderData
            ),
            'type'       => $type,
            'start_time' =>
                $meetingStart->setTimezone(new DateTimeZone('UTC'))->format('Y-m-d\TH:i:s\Z'),
            'duration'   => $duration
        ];

        if ($type === self::RECURRING_WITH_FIXED_TIME_MEETING) {
            $meetingData['recurrence'] = [
                'type'          => 1,
                'end_date_time' => $meetingEnd->setTimezone(new DateTimeZone('UTC'))->format('Y-m-d\TH:i:s\Z'),
            ];
        }

        return $meetingData;
    }
}