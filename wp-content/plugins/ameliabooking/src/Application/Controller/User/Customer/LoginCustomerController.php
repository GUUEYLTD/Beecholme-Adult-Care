<?php

namespace AmeliaBooking\Application\Controller\User\Customer;

use AmeliaBooking\Application\Commands\CommandResult;
use AmeliaBooking\Application\Commands\User\Customer\LoginCustomerCommand;
use AmeliaBooking\Application\Controller\Controller;
use AmeliaBooking\Domain\Events\DomainEventBus;
use Slim\Http\Request;

/**
 * Class LoginCustomerController
 *
 * @package AmeliaBooking\Application\Controller\User\Customer
 */
class LoginCustomerController extends Controller
{
    /**
     * Fields for login that can be received from front-end
     *
     * @var array
     */
    protected $allowedFields = [
        'email',
        'password',
        'token',
        'checkIfWpUser'
    ];

    /**
     * Instantiates the Login Customer command to hand it over to the Command Handler
     *
     * @param Request $request
     * @param         $args
     *
     * @return LoginCustomerCommand
     * @throws \RuntimeException
     */
    protected function instantiateCommand(Request $request, $args)
    {
        $command = new LoginCustomerCommand($args);

        $requestBody = $request->getParsedBody();

        $this->setCommandFields($command, $requestBody);
        $command->setToken($request);

        return $command;
    }

    /**
     * @param DomainEventBus $eventBus
     * @param CommandResult  $result
     *
     * @return void
     */
    protected function emitSuccessEvent(DomainEventBus $eventBus, CommandResult $result)
    {
    }
}
