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
use AmeliaBooking\Domain\Entity\Booking\Event\Event;
use AmeliaBooking\Domain\Entity\Entities;
use AmeliaBooking\Domain\Factory\Booking\Appointment\AppointmentFactory;
use AmeliaBooking\Domain\Services\Settings\SettingsService;
use AmeliaBooking\Infrastructure\Common\Container;
use AmeliaBooking\Infrastructure\Services\Google\GoogleCalendarService;
use AmeliaBooking\Application\Services\Zoom\ZoomApplicationService;

/**
 * Class BookingCanceledEventHandler
 *
 * @package AmeliaBooking\Infrastructure\WP\EventListeners\Booking\Appointment
 */
class BookingCanceledEventHandler
{
    /** @var string */
    const BOOKING_CANCELED = 'bookingCanceled';

    /**
     * @param CommandResult $commandResult
     * @param Container     $container
     *
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\NotFoundException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     * @throws \Slim\Exception\ContainerValueNotFoundException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \Exception
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

        $appointment = $commandResult->getData()[$commandResult->getData()['type']];

        if ($commandResult->getData()['type'] === Entities::APPOINTMENT) {
            /** @var Appointment $reservationObject */
            $reservationObject = AppointmentFactory::create($appointment);

            $bookingApplicationService->setReservationEntities($reservationObject);

            if ($zoomService) {
                $zoomService->handleAppointmentMeeting($reservationObject, self::BOOKING_CANCELED);

                if ($reservationObject->getZoomMeeting()) {
                    $appointment['zoomMeeting'] = $reservationObject->getZoomMeeting()->toArray();
                }
            }

            try {
                $googleCalendarService->handleEvent($reservationObject, self::BOOKING_CANCELED);
            } catch (\Exception $e) {
            }

            if ($reservationObject->getGoogleCalendarEventId() !== null) {
                $appointment['googleCalendarEventId'] = $reservationObject->getGoogleCalendarEventId()->getValue();
            }
        }

        $booking = $commandResult->getData()[Entities::BOOKING];

        $appStatusChanged = $commandResult->getData()['appointmentStatusChanged'];

        $emailNotificationService->sendCustomerBookingNotification($appointment, $booking);

        if ($settingsService->getSetting('notifications', 'smsSignedIn') === true) {
            $smsNotificationService->sendCustomerBookingNotification($appointment, $booking);
        }

        if ($appStatusChanged === true) {
            $bookingKey = array_search($booking['id'], array_column($appointment['bookings'], 'id'), true);

            $appointment['bookings'][$bookingKey]['isChangedStatus'] = true;

            $emailNotificationService->sendAppointmentStatusNotifications($appointment, true, true);

            if ($settingsService->getSetting('notifications', 'smsSignedIn') === true) {
                $smsNotificationService->sendAppointmentStatusNotifications($appointment, true, true);
            }
        }

        $webHookService->process(self::BOOKING_CANCELED, $appointment, [$booking]);
    }
}
