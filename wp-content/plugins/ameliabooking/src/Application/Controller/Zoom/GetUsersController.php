<?php

namespace AmeliaBooking\Application\Controller\Zoom;

use AmeliaBooking\Application\Commands\Zoom\GetUsersCommand;
use AmeliaBooking\Application\Controller\Controller;
use Slim\Http\Request;

/**
 * Class GetUsersController
 *
 * @package AmeliaBooking\Application\Controller\Zoom
 */
class GetUsersController extends Controller
{
    /**
     * Instantiates the Get Zoom Users command to hand it over to the Command Handler
     *
     * @param Request $request
     * @param         $args
     *
     * @return GetUsersCommand
     */
    protected function instantiateCommand(Request $request, $args)
    {
        $command = new GetUsersCommand($args);
        $requestBody = $request->getParsedBody();
        $this->setCommandFields($command, $requestBody);

        return $command;
    }
}
