<?php

namespace AmeliaBooking\Application\Commands\Booking\Appointment;

use AmeliaBooking\Application\Commands\CommandHandler;
use AmeliaBooking\Application\Commands\CommandResult;
use AmeliaBooking\Application\Common\Exceptions\AccessDeniedException;
use AmeliaBooking\Application\Services\Bookable\BookableApplicationService;
use AmeliaBooking\Application\Services\Booking\AppointmentApplicationService;
use AmeliaBooking\Application\Services\Booking\BookingApplicationService;
use AmeliaBooking\Application\Services\CustomField\CustomFieldApplicationService;
use AmeliaBooking\Application\Services\User\CustomerApplicationService;
use AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException;
use AmeliaBooking\Domain\Entity\Bookable\Service\Service;
use AmeliaBooking\Domain\Entity\Booking\Appointment\Appointment;
use AmeliaBooking\Domain\Entity\Entities;
use AmeliaBooking\Domain\Entity\User\AbstractUser;
use AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException;
use AmeliaBooking\Infrastructure\Repository\Booking\Appointment\AppointmentRepository;
use AmeliaBooking\Infrastructure\WP\Translations\FrontendStrings;

/**
 * Class UpdateAppointmentCommandHandler
 *
 * @package AmeliaBooking\Application\Commands\Booking\Appointment
 */
class UpdateAppointmentCommandHandler extends CommandHandler
{
    /**
     * @var array
     */
    public $mandatoryFields = [
        'bookings',
        'bookingStart',
        'notifyParticipants',
        'serviceId',
        'providerId',
        'id'
    ];

    /**
     * @param UpdateAppointmentCommand $command
     *
     * @return CommandResult
     * @throws \Slim\Exception\ContainerException
     * @throws \InvalidArgumentException
     * @throws \Slim\Exception\ContainerValueNotFoundException
     * @throws QueryExecutionException
     * @throws InvalidArgumentException
     * @throws AccessDeniedException
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\NotFoundException
     * @throws \Exception
     */
    public function handle(UpdateAppointmentCommand $command)
    {
        if (!$this->getContainer()->getPermissionsService()->currentUserCanWrite(Entities::APPOINTMENTS)) {
            throw new AccessDeniedException('You are not allowed to update appointment');
        }

        $result = new CommandResult();

        $this->checkMandatoryFields($command);

        /** @var AppointmentRepository $appointmentRepo */
        $appointmentRepo = $this->container->get('domain.booking.appointment.repository');
        /** @var AppointmentApplicationService $appointmentAS */
        $appointmentAS = $this->container->get('application.booking.appointment.service');
        /** @var BookingApplicationService $bookingAS */
        $bookingAS = $this->container->get('application.booking.booking.service');
        /** @var BookableApplicationService $bookableAS */
        $bookableAS = $this->container->get('application.bookable.service');
        /** @var CustomFieldApplicationService $customFieldService */
        $customFieldService = $this->container->get('application.customField.service');
        /** @var CustomerApplicationService $customerAS */
        $customerAS = $this->container->get('application.user.customer.service');

        /** @var Service $service */
        $service = $bookableAS->getAppointmentService(
            $command->getFields()['serviceId'],
            $command->getFields()['providerId']
        );

        /** @var Appointment $appointment */
        $appointment = $appointmentAS->build($command->getFields(), $service);

        /** @var Appointment $oldAppointment */
        $oldAppointment = $appointmentRepo->getById($appointment->getId()->getValue());

        if ($bookingAS->isBookingApprovedOrPending($appointment->getStatus()->getValue()) &&
            $bookingAS->isBookingCanceledOrRejected($oldAppointment->getStatus()->getValue())
        ) {
            /** @var AbstractUser $user */
            $user = $this->container->get('logged.in.user');

            if (!$appointmentAS->canBeBooked($appointment, $customerAS->isCustomer($user))) {
                $result->setResult(CommandResult::RESULT_ERROR);
                $result->setMessage(FrontendStrings::getCommonStrings()['time_slot_unavailable']);
                $result->setData([
                    'timeSlotUnavailable' => true
                ]);

                return $result;
            }
        }

        if (!$appointment instanceof Appointment || !$oldAppointment instanceof Appointment) {
            $result->setResult(CommandResult::RESULT_ERROR);
            $result->setMessage('Could not update appointment');

            return $result;
        }

        $appointment->setGoogleCalendarEventId($oldAppointment->getGoogleCalendarEventId());

        $appointmentRepo->beginTransaction();

        try {
            $appointmentAS->update($oldAppointment, $appointment, $service, $command->getField('payment'));
        } catch (QueryExecutionException $e) {
            $appointmentRepo->rollback();
            throw $e;
        }

        $appointmentRepo->commit();

        $appointmentStatusChanged = $appointmentAS->isAppointmentStatusChanged($appointment, $oldAppointment);

        $appRescheduled = $appointmentAS->isAppointmentRescheduled($appointment, $oldAppointment);

        $appointmentArray = $appointment->toArray();
        $oldAppointmentArray = $oldAppointment->toArray();
        $bookingsWithChangedStatus = $bookingAS->getBookingsWithChangedStatus($appointmentArray, $oldAppointmentArray);

        $result->setResult(CommandResult::RESULT_SUCCESS);
        $result->setMessage('Successfully updated appointment');
        $result->setData([
            Entities::APPOINTMENT       => $appointmentArray,
            'appointmentStatusChanged'  => $appointmentStatusChanged,
            'appointmentRescheduled'    => $appRescheduled,
            'bookingsWithChangedStatus' => $bookingsWithChangedStatus
        ]);

        $customFieldService->deleteUploadedFilesForDeletedBookings(
            $appointment->getBookings(),
            $oldAppointment->getBookings()
        );

        return $result;
    }
}
