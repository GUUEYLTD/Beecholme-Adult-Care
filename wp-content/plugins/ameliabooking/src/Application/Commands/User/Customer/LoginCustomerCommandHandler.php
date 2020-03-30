<?php

namespace AmeliaBooking\Application\Commands\User\Customer;

use AmeliaBooking\Application\Services\User\CustomerApplicationService;
use AmeliaBooking\Application\Commands\CommandResult;
use AmeliaBooking\Application\Commands\CommandHandler;
use AmeliaBooking\Domain\Entity\User\AbstractUser;
use AmeliaBooking\Infrastructure\Repository\User\UserRepository;
use AmeliaBooking\Infrastructure\WP\UserService\UserService;

/**
 * Class LoginCustomerCommandHandler
 *
 * @package AmeliaBooking\Application\Commands\User\Customer
 */
class LoginCustomerCommandHandler extends CommandHandler
{
    /**
     * @param LoginCustomerCommand $command
     *
     * @return CommandResult
     * @throws \Slim\Exception\ContainerException
     * @throws \InvalidArgumentException
     * @throws \UnexpectedValueException
     * @throws \Firebase\JWT\SignatureInvalidException
     * @throws \Firebase\JWT\ExpiredException
     * @throws \Firebase\JWT\BeforeValidException
     * @throws \Slim\Exception\ContainerValueNotFoundException
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     * @throws \AmeliaBooking\Application\Common\Exceptions\AccessDeniedException
     */
    public function handle(LoginCustomerCommand $command)
    {
        $result = new CommandResult();

        /** @var CustomerApplicationService $customerAS */
        $customerAS = $this->container->get('application.user.customer.service');

        /** @var AbstractUser $user */
        $user = $this->container->get('logged.in.user');

        if ($user && $user->getId() !== null) {
            $result = $customerAS->getAuthenticatedUserResponse($user, true, false);

            $result->setData(array_merge($result->getData(), ['is_wp_user' => true]));

            return $result;
        }

        if ($command->getField('checkIfWpUser')) {
            $result->setResult(CommandResult::RESULT_SUCCESS);
            $result->setData([
                'authentication_required' => true
            ]);

            return $result;
        }

        if ($command->getField('token') ?: $command->getToken()) {
            $user = $customerAS->getAuthenticatedUser(
                $command->getField('token') ?: $command->getToken(),
                $command->getField('token') !== null
            );

            if ($user === null) {
                $result->setResult(CommandResult::RESULT_ERROR);
                $result->setMessage('Could not retrieve user');
                $result->setData([
                    'reauthorize' => true
                ]);

                return $result;
            }

            return $customerAS->getAuthenticatedUserResponse($user, true, true);
        }

        if (!$command->getField('email') || !$command->getField('password')) {
            $result->setResult(CommandResult::RESULT_ERROR);
            $result->setMessage('Could not retrieve user');
            $result->setData([
                'invalid_credentials' => true
            ]);

            return $result;
        }

        /** @var UserRepository $userRepository */
        $userRepository = $this->container->get('domain.users.repository');

        $user = $userRepository->getByEmail($command->getField('email'), true, false);

        if (!($user instanceof AbstractUser) ||
            !$user->getPassword() ||
            !$user->getPassword()->checkValidity($command->getField('password'))
        ) {
            /** @var UserService $userService */
            $userService = $this->container->get('users.service');

            $user = $userService->getAuthenticatedUser($command->getField('email'), $command->getField('password'));

            if ($user) {
                return $customerAS->getAuthenticatedUserResponse($user, true, false);
            }

            $result->setResult(CommandResult::RESULT_ERROR);
            $result->setMessage('Could not retrieve user');
            $result->setData([
                'invalid_credentials' => true
            ]);

            return $result;
        }

        return $customerAS->getAuthenticatedUserResponse($user, true, true);
    }


}
