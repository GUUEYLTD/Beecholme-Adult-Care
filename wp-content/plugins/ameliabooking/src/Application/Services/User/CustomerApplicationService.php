<?php

namespace AmeliaBooking\Application\Services\User;

use AmeliaBooking\Application\Commands\CommandResult;
use AmeliaBooking\Application\Common\Exceptions\AccessDeniedException;
use AmeliaBooking\Application\Services\Helper\HelperService;
use AmeliaBooking\Domain\Collection\Collection;
use AmeliaBooking\Domain\Common\Exceptions\AuthorizationException;
use AmeliaBooking\Domain\Entity\Booking\AbstractBooking;
use AmeliaBooking\Domain\Entity\Booking\Appointment\Appointment;
use AmeliaBooking\Domain\Entity\Booking\Appointment\CustomerBooking;
use AmeliaBooking\Domain\Entity\Booking\Event\Event;
use AmeliaBooking\Domain\Entity\Entities;
use AmeliaBooking\Domain\Entity\User\AbstractUser;
use AmeliaBooking\Domain\Entity\User\Customer;
use AmeliaBooking\Domain\Factory\User\UserFactory;
use AmeliaBooking\Domain\Services\DateTime\DateTimeService;
use AmeliaBooking\Domain\Services\Settings\SettingsService;
use AmeliaBooking\Domain\ValueObjects\Json;
use AmeliaBooking\Domain\ValueObjects\Number\Integer\Id;
use AmeliaBooking\Domain\ValueObjects\Number\Integer\LoginType;
use AmeliaBooking\Infrastructure\Common\Container;
use AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException;
use AmeliaBooking\Infrastructure\Repository\Booking\Appointment\AppointmentRepository;
use AmeliaBooking\Infrastructure\Repository\Booking\Appointment\CustomerBookingExtraRepository;
use AmeliaBooking\Infrastructure\Repository\Booking\Appointment\CustomerBookingRepository;
use AmeliaBooking\Infrastructure\Repository\Booking\Event\CustomerBookingEventPeriodRepository;
use AmeliaBooking\Infrastructure\Repository\Booking\Event\EventRepository;
use AmeliaBooking\Infrastructure\Repository\Payment\PaymentRepository;
use AmeliaBooking\Infrastructure\Repository\User\UserRepository;
use Firebase\JWT\JWT;

/**
 * Class CustomerApplicationService
 *
 * @package AmeliaBooking\Application\Services\User
 */
class CustomerApplicationService
{
    private $container;

    /**
     * ProviderApplicationService constructor.
     *
     * @param Container $container
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param AbstractUser        $user
     *
     * @return boolean
     *
     */
    public function isCustomer($user)
    {
        return $user === null || $user->getType() === Entities::CUSTOMER;
    }

    /**
     * @param AbstractUser        $user
     *
     * @return boolean
     *
     */
    public function isAmeliaUser($user)
    {
        return $user &&
            (
                $user->getId() !== null ||
                $user->getType() === AbstractUser::USER_ROLE_ADMIN ||
                $user->getType() === AbstractUser::USER_ROLE_MANAGER
            );
    }

    /**
     * @param CustomerBooking $booking
     * @param AbstractUser    $user
     * @param string          $bookingToken
     *
     * @return boolean
     */
    public function isCustomerBooking($booking, $user, $bookingToken)
    {
        $isValidToken = $bookingToken !== null && $bookingToken === $booking->getToken()->getValue();
        $isValidUser = $user && $user->getId() && $user->getId()->getValue() === $booking->getCustomerId()->getValue();

        if (!($isValidToken || $isValidUser)) {
            return false;
        }

        return true;
    }

    /**
     * Create a new user if doesn't exists. For adding appointment from the front-end.
     *
     * @param array         $userData
     * @param CommandResult $result
     *
     * @return AbstractUser
     *
     * @throws \Slim\Exception\ContainerValueNotFoundException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function getNewOrExistingCustomer($userData, $result)
    {
        /** @var AbstractUser $user */
        $loggedInUser = $this->container->get('logged.in.user');

        if ($loggedInUser) {
            if ($loggedInUser->getType() === AbstractUser::USER_ROLE_ADMIN) {
                $userData['type'] = AbstractUser::USER_ROLE_ADMIN;
            } elseif ($loggedInUser->getType() === AbstractUser::USER_ROLE_MANAGER) {
                $userData['type'] = AbstractUser::USER_ROLE_MANAGER;
            }
        }

        $user = UserFactory::create($userData);

        /** @var UserRepository $userRepository */
        $userRepository = $this->container->get('domain.users.repository');

        // Check if email already exists
        $userWithSameMail = $userRepository->getByEmail($user->getEmail()->getValue());

        if ($userWithSameMail) {
            /** @var SettingsService $settingsService */
            $settingsService = $this->container->get('domain.settings.service');

            // If email already exists, check if First Name and Last Name from request are same with the First Name
            // and Last Name from $userWithSameMail. If these are not same return error message.
            if ($settingsService->getSetting('roles', 'inspectCustomerInfo') &&
                ($userWithSameMail->getFirstName()->getValue() !== $user->getFirstName()->getValue() ||
                    $userWithSameMail->getLastName()->getValue() !== $user->getLastName()->getValue())
            ) {
                $result->setResult(CommandResult::RESULT_ERROR);
                $result->setData(['emailError' => true]);
            }

            return $userWithSameMail;
        }

        return $user;
    }

    /**
     * @param AbstractUser $user
     * @param Collection   $reservations
     *
     * @return void
     *
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     */
    public function removeBookingsForOtherCustomers($user, $reservations)
    {
        $isCustomer = $user === null || ($user && $user->getType() === AbstractUser::USER_ROLE_CUSTOMER);

        /** @var AbstractBooking  $reservation */
        foreach ($reservations->getItems() as $reservation) {
            /** @var CustomerBooking  $booking */
            foreach ($reservation->getBookings()->getItems() as $key => $booking) {
                if ($isCustomer &&
                    (!$user || ($user && $user->getId()->getValue() !== $booking->getCustomerId()->getValue()))
                ) {
                    $reservation->getBookings()->deleteItem($key);
                }
            }
        }
    }

    /**
     * @param Customer $customer
     * @param bool     $isNewCustomer
     *
     * @return void
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function setWPUserForCustomer($customer, $isNewCustomer)
    {
        /** @var SettingsService $settingsService */
        $settingsService = $this->container->get('domain.settings.service');

        $createNewUser = $settingsService->getSetting('roles', 'automaticallyCreateCustomer');

        if ($createNewUser && $isNewCustomer && $customer && $customer->getEmail()) {
            /** @var UserApplicationService $userAS */
            $userAS = $this->container->get('application.user.service');

            try {
                if ($customer->getExternalId()) {
                    $userAS->setWpUserIdForExistingUser($customer->getId()->getValue(), $customer);
                } else {
                    $userAS->setWpUserIdForNewUser($customer->getId()->getValue(), $customer);
                }
            } catch (\Exception $e) {
            }
        }

        if ($createNewUser && $customer && $customer->getExternalId()) {
            $customer->setExternalId(new Id($customer->getExternalId()->getValue()));
        }
    }

    /**
     * @param AbstractUser|Customer $customer
     *
     * @return boolean
     *
     * @throws \Slim\Exception\ContainerValueNotFoundException
     * @throws QueryExecutionException
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     */
    public function delete($customer)
    {
        /** @var AppointmentRepository $appointmentRepository */
        $appointmentRepository = $this->container->get('domain.booking.appointment.repository');

        /** @var EventRepository $eventRepository */
        $eventRepository = $this->container->get('domain.booking.event.repository');

        /** @var CustomerBookingEventPeriodRepository $bookingEventPeriodRepository */
        $bookingEventPeriodRepository = $this->container->get('domain.booking.customerBookingEventPeriod.repository');

        /** @var CustomerBookingRepository $bookingRepository */
        $bookingRepository = $this->container->get('domain.booking.customerBooking.repository');

        /** @var CustomerBookingExtraRepository $customerBookingExtraRepository */
        $customerBookingExtraRepository = $this->container->get('domain.booking.customerBookingExtra.repository');

        /** @var PaymentRepository $paymentRepository */
        $paymentRepository = $this->container->get('domain.payment.repository');

        /** @var UserRepository $userRepository */
        $userRepository = $this->container->get('domain.users.repository');

        /** @var Collection $appointments */
        $appointments = $appointmentRepository->getFiltered([
            'customerId' => $customer->getId()->getValue()
        ]);

        /** @var Appointment $appointment */
        foreach ($appointments->getItems() as $appointment) {
            /** @var CustomerBooking $booking */
            foreach ($appointment->getBookings()->getItems() as $bookingId => $booking) {
                if ($booking->getCustomer()->getId()->getValue() !== $customer->getId()->getValue()) {
                    continue;
                }

                if (
                    !$customerBookingExtraRepository->deleteByEntityId($bookingId, 'customerBookingId') ||
                    !$paymentRepository->deleteByEntityId($bookingId, 'customerBookingId') ||
                    !$bookingRepository->delete($bookingId)
                ) {
                    return false;
                }
            }
        }

        /** @var Collection $events */
        $events = $eventRepository->getFiltered([
            'customerId' => $customer->getId()->getValue()
        ]);

        /** @var Event $event */
        foreach ($events->getItems() as $event) {
            /** @var CustomerBooking $booking */
            foreach ($event->getBookings()->getItems() as $bookingId => $booking) {
                if ($booking->getCustomerId()->getValue() !== $customer->getId()->getValue()) {
                    continue;
                }

                if (
                    !$bookingEventPeriodRepository->deleteByEntityId($bookingId, 'customerBookingId') ||
                    !$paymentRepository->deleteByEntityId($bookingId, 'customerBookingId') ||
                    !$bookingRepository->delete($bookingId)
                ) {
                    return false;
                }
            }
        }

        return $userRepository->delete($customer->getId()->getValue());
    }

    /**
     * @param string  $token
     * @param boolean $isUrlToken
     *
     * @return AbstractUser
     *
     * @throws \InvalidArgumentException
     * @throws \Slim\Exception\ContainerValueNotFoundException
     * @throws \UnexpectedValueException
     * @throws \Firebase\JWT\SignatureInvalidException
     * @throws \Firebase\JWT\ExpiredException
     * @throws \Firebase\JWT\BeforeValidException
     * @throws \Slim\Exception\ContainerException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     * @throws AccessDeniedException
     */
    public function getAuthenticatedUser($token, $isUrlToken)
    {
        /** @var SettingsService $settingsService */
        $settingsService = $this->container->get('domain.settings.service');

        $cabinetSettings = $settingsService->getSetting('roles', 'customerCabinet');

        if (!$cabinetSettings['enabled']) {
            throw new AccessDeniedException('You are not allowed to access this page.');
        }

        try {
            $jwtObject = JWT::decode(
                $token,
                $cabinetSettings[$isUrlToken ? 'urlJwtSecret' : 'headerJwtSecret'],
                array('HS256')
            );
        } catch (\Exception $e) {
            return null;
        }

        /** @var UserRepository $userRepository */
        $userRepository = $this->container->get('domain.users.repository');

        /** @var Customer $user */
        $user = $userRepository->getByEmail($jwtObject->email, true, true);

        $user->setLoginType($jwtObject->wp);

        if (!($user instanceof AbstractUser)) {
            return null;
        }

        if ($isUrlToken) {
            $usedTokens = $user->getUsedTokens() && $user->getUsedTokens()->getValue() ?
                json_decode($user->getUsedTokens()->getValue(), true) : [];

            if (in_array($token, $usedTokens, true)) {
                return null;
            }

            $currentTimeStamp = DateTimeService::getNowDateTimeObject()->getTimestamp() +
                $cabinetSettings['tokenValidTime'];

            foreach ($usedTokens as $tokenKey => $usedToken) {
                if ($tokenKey < $currentTimeStamp) {
                    unset($usedTokens[$tokenKey]);
                }
            }

            $usedTokens[$jwtObject->exp] = $token;

            /** @var Json $newUsedTokens */
            $newUsedTokens = new Json(json_encode($usedTokens));

            $userRepository->updateFieldById($user->getId()->getValue(), $newUsedTokens->getValue(), 'usedTokens');
        }

        return $user;
    }

    /**
     * @param AbstractUser $user
     * @param boolean      $sendToken
     * @param boolean      $checkIfSavedPassword
     * @param int          $loginType
     *
     * @return CommandResult
     *
     * @throws \InvalidArgumentException
     * @throws \Slim\Exception\ContainerValueNotFoundException
     * @throws \UnexpectedValueException
     * @throws \Firebase\JWT\SignatureInvalidException
     * @throws \Firebase\JWT\ExpiredException
     * @throws \Firebase\JWT\BeforeValidException
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \Exception
     */
    public function getAuthenticatedUserResponse($user, $sendToken, $checkIfSavedPassword, $loginType)
    {
        /** @var HelperService $helperService */
        $helperService = $this->container->get('application.helper.service');

        /** @var SettingsService $settingsService */
        $settingsService = $this->container->get('domain.settings.service');

        $cabinetSettings = $settingsService->getSetting('roles', 'customerCabinet');

        $result = new CommandResult();

        $responseData = [Entities::USER => $user->toArray(), 'is_wp_user' => false];

        if (($loginType === LoginType::AMELIA_URL_TOKEN || $loginType === LoginType::AMELIA_CREDENTIALS) &&
            $checkIfSavedPassword &&
            $cabinetSettings['loginEnabled'] &&
            ($user->getPassword() === null || $user->getPassword()->getValue() === null)
        ) {
            $responseData['set_password'] = true;
        }

        if ($sendToken) {
            $responseData['token'] = $helperService->getGeneratedJWT(
                $user->getEmail()->getValue(),
                $cabinetSettings['headerJwtSecret'],
                DateTimeService::getNowDateTimeObject()->getTimestamp() + $cabinetSettings['tokenValidTime'],
                $loginType
            );
        }

        $result->setResult(CommandResult::RESULT_SUCCESS);
        $result->setMessage('Successfully retrieved user');
        $result->setData($responseData);

        return $result;
    }

    /**
     * @param string $token
     *
     * @return AbstractUser
     *
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     * @throws \InvalidArgumentException
     * @throws \Slim\Exception\ContainerValueNotFoundException
     * @throws \UnexpectedValueException
     * @throws \Firebase\JWT\SignatureInvalidException
     * @throws \Firebase\JWT\ExpiredException
     * @throws \Firebase\JWT\BeforeValidException
     * @throws \Slim\Exception\ContainerException
     * @throws \Interop\Container\Exception\ContainerException
     * @throws AccessDeniedException
     * @throws AuthorizationException
     */
    public function authorization($token)
    {
        /** @var SettingsService $settingsService */
        $settingsService = $this->container->get('domain.settings.service');

        $cabinetSettings = $settingsService->getSetting('roles', 'customerCabinet');

        /** @var AbstractUser $user */
        $user = $this->container->get('logged.in.user');

        $isAmeliaWPUser = $user && $user->getId() !== null;

        // check if token exist and user is not logged in as Word Press User and token is valid
        if ($token && !$isAmeliaWPUser && ($user = $this->getAuthenticatedUser($token, false)) === null) {
            throw new AuthorizationException('Authorization Exception.');
        }

        if (!$isAmeliaWPUser && $user->getLoginType() === LoginType::WP_USER) {
            throw new AuthorizationException('Authorization Exception.');
        }

        // if user is not logged in as Word Press User or token not exist/valid
        if (!$this->isAmeliaUser($user)) {
            throw new AuthorizationException('Authorization Exception.');
        }

        $userType = $user->getType();

        // check if user is not logged in as Word Press User and password is required and password is not created
        if (!$isAmeliaWPUser &&
            $userType !== AbstractUser::USER_ROLE_ADMIN &&
            $userType !== AbstractUser::USER_ROLE_MANAGER &&
            $cabinetSettings['loginEnabled'] &&
            $this->isAmeliaUser($user) &&
            ($user->getLoginType() === LoginType::AMELIA_URL_TOKEN || $user->getLoginType() === LoginType::AMELIA_CREDENTIALS) &&
            (!$user->getPassword() || !$user->getPassword()->getValue())
        ) {
            throw new AuthorizationException('Authorization Exception.');
        }

        return $user;
    }
}
