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
 * Class AppointmentDeletedEventHandler
 *
 * @package AmeliaBooking\Infrastructure\WP\EventListeners\Booking\Appointment
 */
class AppointmentDeletedEventHandler
{
    /** @var string */
    const APPOINTMENT_DELETED = 'appointmentDeleted';

    /** @var string */
    const BOOKING_STATUS_UPDATED = 'bookingStatusUpdated';

    /**
     * @param CommandResult $commandResult
     * @param Container     $container
     *
     * @throws /AmeliaBooking\Infrastructure\Common\Exceptions\NotFoundException
     * @throws /AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException
     * @throws /Interop\Container\Exception\ContainerException
     * @throws /AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
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

        $appointment = $commandResult->getData()[Entities::APPOINTMENT];

        $bookings = $commandResult->getData()['bookingsWithChangedStatus'];

        /** @var Appointment|Event $reservationObject */
        $reservationObject = AppointmentFactory::create($appointment);

        $bookingApplicationService->setReservationEntities($reservationObject);

        if ($zoomService) {
            $zoomService->handleAppointmentMeeting($reservationObject, self::APPOINTMENT_DELETED);

            $appointment['zoomMeeting'] = null;
        }

        try {
            $googleCalendarService->handleEvent($reservationObject, self::APPOINTMENT_DELETED);
        } catch (\Exception $e) {
        }

        $emailNotificationService->sendAppointmentStatusNotifications($appointment, false, false);

        if ($settingsService->getSetting('notifications', 'smsSignedIn') === true) {
            $smsNotificationService->sendAppointmentStatusNotifications($appointment, false, false);
        }

        if ($bookings) {
            $webHookService->process(self::BOOKING_STATUS_UPDATED, $appointment, $bookings);
        }
    }
}
