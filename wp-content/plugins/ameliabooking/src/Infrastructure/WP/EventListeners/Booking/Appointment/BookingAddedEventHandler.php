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
use AmeliaBooking\Domain\Entity\Booking\Appointment\CustomerBooking;
use AmeliaBooking\Domain\Entity\Booking\Event\Event;
use AmeliaBooking\Domain\Entity\Entities;
use AmeliaBooking\Domain\Services\Reservation\ReservationServiceInterface;
use AmeliaBooking\Domain\Services\Settings\SettingsService;
use AmeliaBooking\Domain\ValueObjects\BooleanValueObject;
use AmeliaBooking\Infrastructure\Common\Container;
use AmeliaBooking\Infrastructure\Services\Google\GoogleCalendarService;
use AmeliaBooking\Application\Services\Zoom\ZoomApplicationService;
use Exception;

/**
 * Class BookingAddedEventHandler
 *
 * @package AmeliaBooking\Infrastructure\WP\EventListeners\Booking\Appointment
 */
class BookingAddedEventHandler
{
    /** @var string */
    const BOOKING_ADDED = 'bookingAdded';

    /**
     * @param CommandResult $commandResult
     * @param Container     $container
     *
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\NotFoundException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     * @throws \Slim\Exception\ContainerValueNotFoundException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException
     * @throws \Interop\Container\Exception\ContainerException
     * @throws Exception
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
        /** @var ZoomApplicationService $zoomService */
        $zoomService = $container->get('application.zoom.service');
        /** @var BookingApplicationService $bookingApplicationService */
        $bookingApplicationService = $container->get('application.booking.booking.service');

        $type = $commandResult->getData()['type'];

        $booking = $commandResult->getData()[Entities::BOOKING];
        $appointmentStatusChanged = $commandResult->getData()['appointmentStatusChanged'];

        /** @var ReservationServiceInterface $reservationService */
        $reservationService = $container->get('application.reservation.service')->get($type);

        /** @var Appointment|Event $reservationObject */
        $reservationObject = $reservationService->getReservationById(
            (int)$commandResult->getData()[$type]['id']
        );

        /** @var CustomerBooking $bookingObject */
        foreach ($reservationObject->getBookings()->getItems() as $bookingObject) {
            if ($bookingObject->getId()->getValue() === $booking['id']) {
                $bookingObject->setChangedStatus(new BooleanValueObject(true));
            }
        }

        $reservation = $reservationObject->toArray();

        if ($type === Entities::APPOINTMENT) {
            $bookingApplicationService->setReservationEntities($reservationObject);

            if ($zoomService) {
                $zoomService->handleAppointmentMeeting($reservationObject, self::BOOKING_ADDED);

                if ($reservationObject->getZoomMeeting()) {
                    $reservation['zoomMeeting'] = $reservationObject->getZoomMeeting()->toArray();
                }
            }

            try {
                $googleCalendarService->handleEvent($reservationObject, self::BOOKING_ADDED);
            } catch (Exception $e) {
            }

            if ($reservationObject->getGoogleCalendarEventId() !== null) {
                $reservation['googleCalendarEventId'] = $reservationObject->getGoogleCalendarEventId()->getValue();
            }
        }

        if ($type === Entities::EVENT) {
            if ($zoomService) {
                $zoomService->handleEventMeeting($reservationObject, $reservationObject->getPeriods(), self::BOOKING_ADDED);

                $reservation['periods'] = $reservationObject->getPeriods()->toArray();
            }
        }

        if ($appointmentStatusChanged === true) {
            $emailNotificationService->sendAppointmentStatusNotifications($reservation, true, true);

            if ($settingsService->getSetting('notifications', 'smsSignedIn') === true) {
                $smsNotificationService->sendAppointmentStatusNotifications($reservation, true, true);
            }
        }

        if ($appointmentStatusChanged !== true) {
            $emailNotificationService->sendBookingAddedNotifications($reservation, $booking, true);

            if ($settingsService->getSetting('notifications', 'smsSignedIn') === true) {
                $smsNotificationService->sendBookingAddedNotifications($reservation, $booking, true);
            }
        }

        $webHookService->process(self::BOOKING_ADDED, $reservation, [$booking]);
    }
}
