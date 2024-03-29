<?php
/**
 * @copyright © TMS-Plugins. All rights reserved.
 * @licence   See LICENCE.md for license details.
 */

namespace AmeliaBooking\Infrastructure\WP\EventListeners\Booking\Appointment;

use AmeliaBooking\Application\Commands\CommandResult;
use AmeliaBooking\Application\Services\Booking\BookingApplicationService;
use AmeliaBooking\Application\Services\Notification\EmailNotificationService;
use AmeliaBooking\Application\Services\Notification\SMSNotificationService;
use AmeliaBooking\Application\Services\WebHook\WebHookApplicationService;
use AmeliaBooking\Domain\Entity\Booking\Appointment\Appointment;
use AmeliaBooking\Domain\Entity\Entities;
use AmeliaBooking\Domain\Factory\Booking\Appointment\AppointmentFactory;
use AmeliaBooking\Domain\Services\DateTime\DateTimeService;
use AmeliaBooking\Domain\Services\Settings\SettingsService;
use AmeliaBooking\Infrastructure\Common\Container;
use AmeliaBooking\Infrastructure\Services\Google\GoogleCalendarService;
use AmeliaBooking\Application\Services\Zoom\ZoomApplicationService;

/**
 * Class AppointmentAddedEventHandler
 *
 * @package AmeliaBooking\Infrastructure\WP\EventListeners\Booking\Appointment
 */
class AppointmentAddedEventHandler
{
    /** @var string */
    const APPOINTMENT_ADDED = 'appointmentAdded';

    /** @var string */
    const BOOKING_ADDED = 'bookingAdded';

    /**
     * @param CommandResult $commandResult
     * @param Container     $container
     *
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\NotFoundException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     */
    public static function handle($commandResult, $container)
    {
        /** @var GoogleCalendarService $googleCalendarService */
        $googleCalendarService = $container->get('infrastructure.google.calendar.service');
        /** @var EmailNotificationService $emailNotificationService */
        $emailNotificationService = $container->get('application.emailNotification.service');
        /** @var SMSNotificationService $smsNotificationService */
        $smsNotificationService = $container->get('application.smsNotification.service');
        /** @var SettingsService $settingsService */
        $settingsService = $container->get('domain.settings.service');
        /** @var WebHookApplicationService $webHookService */
        $webHookService = $container->get('application.webHook.service');
        /** @var BookingApplicationService $bookingApplicationService */
        $bookingApplicationService = $container->get('application.booking.booking.service');
        /** @var ZoomApplicationService $zoomService */
        $zoomService = $container->get('application.zoom.service');

        $recurringData = $commandResult->getData()['recurring'];

        $appointment = $commandResult->getData()[Entities::APPOINTMENT];

        /** @var Appointment $appointmentObject */
        $appointmentObject = AppointmentFactory::create($appointment);

        $bookingApplicationService->setReservationEntities($appointmentObject);

        $pastAppointment =  $appointmentObject->getBookingStart()->getValue() < DateTimeService::getNowDateTimeObject();

        if ($zoomService && !$pastAppointment) {
            $zoomService->handleAppointmentMeeting($appointmentObject, self::APPOINTMENT_ADDED);

            if ($appointmentObject->getZoomMeeting()) {
                $appointment['zoomMeeting'] = $appointmentObject->getZoomMeeting()->toArray();
            }
        }

        if ($googleCalendarService) {
            try {
                $googleCalendarService->handleEvent($appointmentObject, self::APPOINTMENT_ADDED);
            } catch (\Exception $e) {
            }
        }

        foreach ($recurringData as $key => $recurringReservationData) {
            /** @var Appointment $recurringReservationObject */
            $recurringReservationObject = AppointmentFactory::create($recurringReservationData[Entities::APPOINTMENT]);

            $bookingApplicationService->setReservationEntities($recurringReservationObject);

            if ($zoomService && !$pastAppointment) {
                $zoomService->handleAppointmentMeeting($recurringReservationObject, self::BOOKING_ADDED);

                if ($recurringReservationObject->getZoomMeeting()) {
                    $recurringData[$key][Entities::APPOINTMENT]['zoomMeeting'] =
                        $recurringReservationObject->getZoomMeeting()->toArray();
                }
            }

            if ($googleCalendarService) {
                try {
                    $googleCalendarService->handleEvent($recurringReservationObject, self::BOOKING_ADDED);
                } catch (\Exception $e) {
                }

                if ($recurringReservationObject->getGoogleCalendarEventId() !== null) {
                    $recurringData[$key][Entities::APPOINTMENT]['googleCalendarEventId'] =
                        $recurringReservationObject->getGoogleCalendarEventId()->getValue();
                }
            }
        }

        $appointment['recurring'] = $recurringData;

        if (!$pastAppointment) {
            $emailNotificationService->sendAppointmentStatusNotifications($appointment, false, true);

            if ($settingsService->getSetting('notifications', 'smsSignedIn') === true) {
                $smsNotificationService->sendAppointmentStatusNotifications($appointment, false, true);
            }
        }

        $webHookService->process(self::BOOKING_ADDED, $appointment, $appointment['bookings']);

        foreach ($recurringData as $key => $recurringReservationData) {
            $webHookService->process(
                self::BOOKING_ADDED,
                $recurringReservationData[Entities::APPOINTMENT],
                $recurringReservationData[Entities::APPOINTMENT]['bookings']
            );
        }
    }
}
