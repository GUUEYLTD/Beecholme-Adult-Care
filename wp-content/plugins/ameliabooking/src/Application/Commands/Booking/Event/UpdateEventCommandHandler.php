<?php

namespace AmeliaBooking\Application\Commands\Booking\Event;

use AmeliaBooking\Application\Commands\CommandHandler;
use AmeliaBooking\Application\Commands\CommandResult;
use AmeliaBooking\Application\Common\Exceptions\AccessDeniedException;
use AmeliaBooking\Application\Services\Booking\EventApplicationService;
use AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException;
use AmeliaBooking\Domain\Entity\Booking\Event\Event;
use AmeliaBooking\Domain\Entity\Booking\Event\EventPeriod;
use AmeliaBooking\Domain\Entity\Entities;
use AmeliaBooking\Domain\Factory\Booking\Event\EventFactory;
use AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException;
use AmeliaBooking\Infrastructure\Repository\Booking\Event\EventRepository;

/**
 * Class UpdateEventCommandHandler
 *
 * @package AmeliaBooking\Application\Commands\Booking\Event
 */
class UpdateEventCommandHandler extends CommandHandler
{
    /**
     * @var array
     */
    public $mandatoryFields = [
        'id',
        'name',
        'periods',
        'applyGlobally'
    ];

    /**
     * @param UpdateEventCommand $command
     *
     * @return CommandResult
     * @throws \Slim\Exception\ContainerValueNotFoundException
     * @throws QueryExecutionException
     * @throws InvalidArgumentException
     * @throws AccessDeniedException
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function handle(UpdateEventCommand $command)
    {
        if (!$this->getContainer()->getPermissionsService()->currentUserCanWrite(Entities::EVENTS)) {
            throw new AccessDeniedException('You are not allowed to update event');
        }

        $result = new CommandResult();

        $this->checkMandatoryFields($command);

        /** @var EventRepository $eventRepository */
        $eventRepository = $this->container->get('domain.booking.event.repository');

        /** @var EventApplicationService $eventApplicationService */
        $eventApplicationService = $this->container->get('application.booking.event.service');

        /** @var Event $event */
        $event = EventFactory::create($command->getFields());

        if (!$event instanceof Event) {
            $result->setResult(CommandResult::RESULT_ERROR);
            $result->setMessage('Could not update event');

            return $result;
        }

        /** @var Event $oldEvent */
        $oldEvent = $eventRepository->getById($event->getId()->getValue());

        if ($oldEvent->getRecurring() &&
            $event->getRecurring() &&
            (
                $event->getRecurring()->getUntil()->getValue() < $oldEvent->getRecurring()->getUntil()->getValue() ||
                $event->getRecurring()->getCycle()->getValue() !== $oldEvent->getRecurring()->getCycle()->getValue()
            )
        ) {
            $result->setResult(CommandResult::RESULT_ERROR);
            $result->setMessage('Could not update event');

            return $result;
        }

        $event->setBookings($oldEvent->getBookings());

        if (!$event instanceof Event) {
            $result->setResult(CommandResult::RESULT_ERROR);
            $result->setMessage('Could not update event');

            return $result;
        }

        /** @var EventPeriod $oldEventPeriod */
        foreach ($oldEvent->getPeriods()->getItems() as $oldEventPeriod) {
            /** @var EventPeriod $eventPeriod */
            foreach ($event->getPeriods()->getItems() as $eventPeriod) {
                if ($eventPeriod->getId() && $oldEventPeriod->getId()->getValue() === $eventPeriod->getId()->getValue() && $oldEventPeriod->getZoomMeeting()) {
                    $eventPeriod->setZoomMeeting($oldEventPeriod->getZoomMeeting());
                }
            }
        }

        $eventRepository->beginTransaction();

        try {
            $parsedEvents = $eventApplicationService->update(
                $oldEvent,
                $event,
                $command->getField('applyGlobally')
            );
        } catch (QueryExecutionException $e) {
            $eventRepository->rollback();
            throw $e;
        }

        $eventRepository->commit();

        $result->setResult(CommandResult::RESULT_SUCCESS);
        $result->setMessage('Successfully updated event.');
        $result->setData(
            [
                Entities::EVENTS => $parsedEvents,
                'zoomUserAdded'  => $event->getZoomUserId() && !$oldEvent->getZoomUserId()
            ]
        );

        return $result;
    }
}
