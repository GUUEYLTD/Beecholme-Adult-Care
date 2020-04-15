<?php

namespace AmeliaBooking\Application\Commands\Zoom;

use AmeliaBooking\Application\Commands\CommandHandler;
use AmeliaBooking\Application\Commands\CommandResult;
use AmeliaBooking\Application\Common\Exceptions\AccessDeniedException;
use AmeliaBooking\Domain\Entity\Entities;
use AmeliaBooking\Domain\Services\Settings\SettingsService;
use AmeliaBooking\Infrastructure\Services\Zoom\ZoomService;
use Interop\Container\Exception\ContainerException;

/**
 * Class GetUsersCommandHandler
 *
 * @package AmeliaBooking\Application\Commands\Zoom
 */
class GetUsersCommandHandler extends CommandHandler
{
    /**
     * @param GetUsersCommand $command
     *
     * @return CommandResult
     * @throws ContainerException
     * @throws AccessDeniedException
     */
    public function handle(GetUsersCommand $command)
    {
        if (!$this->getContainer()->getPermissionsService()->currentUserCanRead(Entities::EMPLOYEES)) {
            throw new AccessDeniedException('You are not allowed to read users.');
        }

        $result = new CommandResult();

        /** @var SettingsService $settingsDS */
        $settingsDS = $this->container->get('domain.settings.service');

        $zoomSettings = $settingsDS->getCategorySettings('zoom');

        if (!$zoomSettings['apiKey'] || !$zoomSettings['apiSecret']) {
            $result->setResult(CommandResult::RESULT_SUCCESS);

            return $result;
        }

        /** @var ZoomService $zoomService */
        $zoomService = $this->container->get('infrastructure.zoom.service');

        if (!$zoomService) {
            $result->setResult(CommandResult::RESULT_SUCCESS);

            return $result;
        }

        $zoomResult = $zoomService->getUsers();

        if (isset($zoomResult['code']) && $zoomResult['code'] === 124) {
            $result->setResult(CommandResult::RESULT_ERROR);
            $result->setMessage($zoomResult['message']);

            return $result;
        }

        $result->setResult(CommandResult::RESULT_SUCCESS);
        $result->setMessage('Successfully retrieved users');
        $result->setData([
            'users' => $zoomResult['users']
        ]);

        return $result;
    }
}
