<?php
/**
 * @copyright © TMS-Plugins. All rights reserved.
 * @licence   See LICENCE.md for license details.
 */

namespace AmeliaBooking\Application\Services\Placeholder;

use AmeliaBooking\Application\Services\Coupon\CouponApplicationService;
use AmeliaBooking\Application\Services\Helper\HelperService;
use AmeliaBooking\Domain\Collection\Collection;
use AmeliaBooking\Domain\Common\Exceptions\CouponInvalidException;
use AmeliaBooking\Domain\Common\Exceptions\CouponUnknownException;
use AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException;
use AmeliaBooking\Domain\Entity\Booking\Event\Event;
use AmeliaBooking\Domain\Entity\Coupon\Coupon;
use AmeliaBooking\Domain\Entity\CustomField\CustomField;
use AmeliaBooking\Domain\Entity\Entities;
use AmeliaBooking\Domain\Entity\User\AbstractUser;
use AmeliaBooking\Domain\Entity\User\Customer;
use AmeliaBooking\Domain\Services\Settings\SettingsService;
use AmeliaBooking\Domain\ValueObjects\String\BookingStatus;
use AmeliaBooking\Infrastructure\Common\Container;
use AmeliaBooking\Infrastructure\Common\Exceptions\NotFoundException;
use AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException;
use AmeliaBooking\Infrastructure\Repository\Booking\Appointment\AppointmentRepository;
use AmeliaBooking\Infrastructure\Repository\Booking\Event\EventRepository;
use AmeliaBooking\Infrastructure\Repository\Coupon\CouponRepository;
use AmeliaBooking\Infrastructure\Repository\CustomField\CustomFieldRepository;
use AmeliaBooking\Infrastructure\Repository\User\UserRepository;
use AmeliaBooking\Infrastructure\WP\Translations\BackendStrings;
use AmeliaBooking\Infrastructure\WP\Translations\FrontendStrings;
use Exception;
use Interop\Container\Exception\ContainerException;

/**
 * Class PlaceholderService
 *
 * @package AmeliaBooking\Application\Services\Notification
 */
abstract class PlaceholderService implements PlaceholderServiceInterface
{
    /** @var Container */
    protected $container;

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
     * @param string $text
     * @param array  $data
     *
     * @return mixed
     */
    public function applyPlaceholders($text, $data)
    {
        $placeholders = array_map(
            function ($placeholder) {
                return "%{$placeholder}%";
            },
            array_keys($data)
        );

        return str_replace($placeholders, array_values($data), $text);
    }

    /**
     * @return array
     *
     * @throws ContainerException
     */
    public function getPlaceholdersDummyData()
    {
        /** @var SettingsService $settingsService */
        $settingsService = $this->container->get('domain.settings.service');

        $companySettings = $settingsService->getCategorySettings('company');

        return array_merge([
            'company_address'     => $companySettings['address'],
            'company_name'        => $companySettings['name'],
            'company_phone'       => $companySettings['phone'],
            'company_website'     => $companySettings['website'],
            'customer_email'      => 'customer@domain.com',
            'customer_first_name' => 'John',
            'customer_last_name'  => 'Doe',
            'customer_full_name'  => 'John Doe',
            'customer_phone'      => '193-951-2600',
            'customer_note'       => 'Customer Note',
        ], $this->getEntityPlaceholdersDummyData());
    }

    /** @noinspection MoreThanThreeArgumentsInspection */
    /**
     * @param array        $appointment
     * @param int          $bookingKey
     * @param string       $token
     * @param string       $type
     * @param AbstractUser $customer
     *
     * @return array
     *
     * @throws InvalidArgumentException
     * @throws \Slim\Exception\ContainerValueNotFoundException
     * @throws NotFoundException
     * @throws QueryExecutionException
     * @throws ContainerException
     * @throws Exception
     */
    public function getPlaceholdersData($appointment, $bookingKey = null, $token = null, $type = null, $customer = null)
    {
        $data = $this->getEntityPlaceholdersData($appointment, $bookingKey, $token, $type);

        $data = array_merge($data, $this->getBookingData($appointment, $type, $bookingKey, $token));
        $data = array_merge($data, $this->getCompanyData());
        $data = array_merge($data, $this->getCustomersData($appointment, $type, $bookingKey, $customer));
        $data = array_merge($data, $this->getCustomFieldsData($appointment, $bookingKey));
        $data = array_merge($data, $this->getCouponsData($appointment, $type, $bookingKey));

        return $data;
    }

    /**
     * @return array
     *
     * @throws ContainerException
     */
    public function getCompanyData()
    {
        /** @var SettingsService $settingsService */
        $settingsService = $this->container->get('domain.settings.service');

        $companySettings = $settingsService->getCategorySettings('company');

        return [
            'company_address' => $companySettings['address'],
            'company_name'    => $companySettings['name'],
            'company_phone'   => $companySettings['phone'],
            'company_website' => $companySettings['website']
        ];
    }

    /**
     * @param array  $appointment
     * @param string $type
     * @param null   $bookingKey
     * @param null   $token
     *
     * @return array
     *
     * @throws ContainerException
     */
    protected function getBookingData($appointment, $type, $bookingKey = null, $token = null)
    {
        /** @var HelperService $helperService */
        $helperService = $this->container->get('application.helper.service');

        /** @var string $break */
        $break = $type === 'email' ? '<br>' : PHP_EOL;

        $numberOfPersons = null;

        $couponsUsed = [];

        $appointmentPrice = 0;
        // If notification is for provider: Appointment price will be sum of all bookings prices
        // If notification is for customer: Appointment price will be price of his booking
        if ($bookingKey === null) {
            $numberOfPersonsData = [
                AbstractUser::USER_ROLE_PROVIDER => [
                    BookingStatus::APPROVED => 0,
                    BookingStatus::PENDING  => 0,
                    BookingStatus::CANCELED => 0,
                    BookingStatus::REJECTED => 0,
                ]
            ];

            foreach ((array)$appointment['bookings'] as $customerBooking) {
                $isAggregatedPrice = isset($customerBooking['aggregatedPrice']) && $customerBooking['aggregatedPrice'];

                $appointmentPrice = $customerBooking['price'] *
                    ($isAggregatedPrice ? $customerBooking['persons'] : 1);

                foreach ((array)$customerBooking['extras'] as $extra) {
                    $isExtraAggregatedPrice = isset($extra['aggregatedPrice']) && $extra['aggregatedPrice'] !== null ?
                        $extra['aggregatedPrice'] : $isAggregatedPrice;

                    $appointmentPrice += $extra['price'] *
                        $extra['quantity'] *
                        ($isExtraAggregatedPrice ? $customerBooking['persons'] : 1);
                }

                $discountValue = 0;

                if (!empty($customerBooking['coupon']['discount'])) {
                    $discountValue = $appointmentPrice -
                        (1 - $customerBooking['coupon']['discount'] / 100) * $appointmentPrice;

                    $appointmentPrice =
                        (1 - $customerBooking['coupon']['discount'] / 100) * $appointmentPrice;
                }

                $deductionValue = 0;

                if (!empty($customerBooking['coupon']['deduction'])) {
                    $deductionValue = $customerBooking['coupon']['deduction'];

                    $appointmentPrice -= $customerBooking['coupon']['deduction'];
                }

                if ($discountValue || $deductionValue) {
                    $customerData = json_decode($customerBooking['info'], true);

                    $couponsUsed[] =
                        BackendStrings::getCommonStrings()['customer'] . ': ' .
                        $customerData['firstName'] . ' ' . $customerData['lastName'] . $break .
                        BackendStrings::getFinanceStrings()['code'] . ': ' .
                        $customerBooking['coupon']['code'] . $break .
                        ($discountValue ? BackendStrings::getPaymentStrings()['discount_amount'] . ': ' .
                            $helperService->getFormattedPrice($discountValue) . $break : '') .
                        ($deductionValue ? BackendStrings::getPaymentStrings()['deduction'] . ': ' .
                            $helperService->getFormattedPrice($deductionValue) : '');
                }

                $numberOfPersonsData[AbstractUser::USER_ROLE_PROVIDER][$customerBooking['status']] +=
                    $customerBooking['persons'];
            }

            $numberOfPersons = [];

            foreach ($numberOfPersonsData[AbstractUser::USER_ROLE_PROVIDER] as $key => $value) {
                if ($value) {
                    $numberOfPersons[] = BackendStrings::getCommonStrings()[$key] . ': ' . $value;
                }
            }

            $numberOfPersons = implode($break, $numberOfPersons);
        } else {
            $isAggregatedPrice = isset($appointment['bookings'][$bookingKey]['aggregatedPrice']) &&
                $appointment['bookings'][$bookingKey]['aggregatedPrice'];

            $appointmentPrice = $appointment['bookings'][$bookingKey]['price'] *
                ($isAggregatedPrice ? $appointment['bookings'][$bookingKey]['persons'] : 1);

            foreach ((array)$appointment['bookings'][$bookingKey]['extras'] as $extra) {
                $isExtraAggregatedPrice = isset($extra['aggregatedPrice']) && $extra['aggregatedPrice'] !== null ? $extra['aggregatedPrice'] :
                    $isAggregatedPrice;

                $appointmentPrice +=
                    $extra['price'] *
                    $extra['quantity'] *
                    ($isExtraAggregatedPrice ? $appointment['bookings'][$bookingKey]['persons'] : 1);
            }

            if (!empty($appointment['bookings'][$bookingKey]['coupon']['discount'])) {
                $appointmentPrice =
                    (1 - $appointment['bookings'][$bookingKey]['coupon']['discount'] / 100) * $appointmentPrice;
            }

            if (!empty($appointment['bookings'][$bookingKey]['coupon']['deduction'])) {
                $appointmentPrice -= $appointment['bookings'][$bookingKey]['coupon']['deduction'];
            }

            $numberOfPersons = $appointment['bookings'][$bookingKey]['persons'];
        }

        return [
            "{$appointment['type']}_cancel_url" => $bookingKey !== null ?
                AMELIA_ACTION_URL . '/bookings/cancel/' . $appointment['bookings'][$bookingKey]['id'] .
                ($token ? '&token=' . $token : '') . "&type={$appointment['type']}" : '',
            "{$appointment['type']}_price"      => $helperService->getFormattedPrice($appointmentPrice),
            'number_of_persons'                 => $numberOfPersons,
            'coupon_used'                       => $couponsUsed ? implode($break, $couponsUsed) : ''
        ];
    }

    /** @noinspection MoreThanThreeArgumentsInspection */
    /**
     * @param array    $appointment
     * @param string   $type
     * @param null     $bookingKey
     * @param Customer $customerEntity
     *
     * @return array
     *
     * @throws \Slim\Exception\ContainerException
     * @throws \InvalidArgumentException
     * @throws \Slim\Exception\ContainerValueNotFoundException
     * @throws NotFoundException
     * @throws QueryExecutionException
     * @throws ContainerException
     */
    private function getCustomersData($appointment, $type, $bookingKey = null, $customerEntity = null)
    {
        /** @var UserRepository $userRepository */
        $userRepository = $this->container->get('domain.users.repository');

        // If the data is for employee
        if ($bookingKey === null) {
            $customers = [];
            $customerInformationData = [];

            $hasApprovedOrPendingStatus = in_array(
                    BookingStatus::APPROVED,
                    array_column($appointment['bookings'], 'status'),
                    true
                ) ||
                in_array(
                    BookingStatus::PENDING,
                    array_column($appointment['bookings'], 'status'),
                    true
                );

            $bookedCustomerFullName = '';
            $bookedCustomerEmail = '';
            $bookedCustomerPhone = '';

            foreach ((array)$appointment['bookings'] as $customerBooking) {
                /** @var AbstractUser $customer */
                $customer = $userRepository->getById($customerBooking['customerId']);

                if ((!$hasApprovedOrPendingStatus && $customerBooking['isChangedStatus']) ||
                    ($customerBooking['status'] !== BookingStatus::CANCELED && $customerBooking['status'] !== BookingStatus::REJECTED)
                ) {
                    if ($customerBooking['info']) {
                        $customerInformationData[] = json_decode($customerBooking['info'], true);
                    } else {
                        $customerInformationData[] = [
                            'firstName' => $customer->getFirstName()->getValue(),
                            'lastName'  => $customer->getLastName()->getValue(),
                            'phone'     => $customer->getPhone() ? $customer->getPhone()->getValue() : '',
                        ];
                    }

                    $customers[] = $customer;
                }

                if ($customerBooking['isChangedStatus']) {
                    $bookedCustomerFullName = $customer->getFullName();
                    $bookedCustomerEmail = $customer->getEmail() ? $customer->getEmail()->getValue() : '';
                    $bookedCustomerPhone = $customer->getPhone() ? $customer->getPhone()->getValue() : '';
                }
            }

            $phones = '';
            foreach ($customerInformationData as $key => $info) {
                if ($info['phone']) {
                    $phones .= $info['phone'] . ', ';
                } else {
                    $phones .= $customers[$key]->getPhone() ? $customers[$key]->getPhone()->getValue() . ', ' : '';
                }
            }

            $bookedCustomer = '<p>' . BackendStrings::getNotificationsStrings()['ph_customer_full_name'] . ': ' . $bookedCustomerFullName . '</p>';

            $bookedCustomer .= $bookedCustomerPhone ? '<p>' . BackendStrings::getNotificationsStrings()['ph_customer_phone'] . ': ' . $bookedCustomerPhone . '</p>' : '';
            $bookedCustomer .= $bookedCustomerEmail ? '<p>' . BackendStrings::getNotificationsStrings()['ph_customer_email'] . ': ' . $bookedCustomerEmail . '</p>' : '';

            return [
                'booked_customer'     => substr($bookedCustomer, 3, strlen($bookedCustomer) - 7),
                'customer_email'      => implode(', ', array_map(function ($customer) {
                    /** @var Customer $customer */
                    return $customer->getEmail()->getValue();
                }, $customers)),
                'customer_first_name' => implode(', ', array_map(function ($info) {
                    return $info['firstName'];
                }, $customerInformationData)),
                'customer_last_name'  => implode(', ', array_map(function ($info) {
                    return $info['lastName'];
                }, $customerInformationData)),
                'customer_full_name'  => implode(', ', array_map(function ($info) {
                    return $info['firstName'] . ' ' . $info['lastName'];
                }, $customerInformationData)),
                'customer_phone'      => substr($phones, 0, -2),
                'customer_note'       => implode(', ', array_map(function ($customer) {
                    /** @var Customer $customer */
                    return $customer->getNote() ? $customer->getNote()->getValue() : '';
                }, $customers))
            ];
        }

        // If data is for customer
        /** @var Customer $customer */
        $customer = $customerEntity ? $customerEntity : $userRepository->getById($appointment['bookings'][$bookingKey]['customerId']);

        $info = json_decode($appointment['bookings'][$bookingKey]['info']);

        if ($info && $info->phone) {
            $phone = $info->phone;
        } else {
            $phone = $customer->getPhone() ? $customer->getPhone()->getValue() : '';
        }

        /** @var HelperService $helperService */
        $helperService = $this->container->get('application.helper.service');

        return [
            'customer_email'      => $customer->getEmail() ? $customer->getEmail()->getValue() : '',
            'customer_first_name' => $info ? $info->firstName : $customer->getFirstName()->getValue(),
            'customer_last_name'  => $info ? $info->lastName : $customer->getLastName()->getValue(),
            'customer_full_name'  => $info ? $info->firstName . ' ' . $info->lastName : $customer->getFullName(),
            'customer_phone'      => $phone,
            'customer_note'       => $customer->getNote() ? $customer->getNote()->getValue() : '',
            'customer_panel_url'  => $helperService->getCustomerCabinetUrl(
                $customer->getEmail()->getValue(),
                $type,
                !empty($appointment['bookingStart']) ? explode(' ', $appointment['bookingStart'])[0] : null,
                !empty($appointment['bookingEnd']) ? explode(' ', $appointment['bookingEnd'])[0] : null
            )
        ];
    }

    /**
     * @param array $appointment
     * @param null  $bookingKey
     *
     * @return array
     * @throws \Slim\Exception\ContainerValueNotFoundException
     * @throws ContainerException
     * @throws QueryExecutionException
     */
    private function getCustomFieldsData($appointment, $bookingKey = null)
    {
        $customFieldsData = [];

        $bookingCustomFieldsKeys = [];

        if ($bookingKey === null) {
            foreach ($appointment['bookings'] as $booking) {
                $bookingCustomFields = json_decode($booking['customFields'], true);

                if ($bookingCustomFields) {
                    foreach ($bookingCustomFields as $bookingCustomFieldKey => $bookingCustomField) {
                        if (isset($bookingCustomField['value'], $bookingCustomField['type']) && $bookingCustomField['type'] !== 'file') {
                            if (array_key_exists(
                                'custom_field_' . $bookingCustomFieldKey,
                                $customFieldsData
                            )) {
                                $customFieldsData['custom_field_' . $bookingCustomFieldKey]
                                    .= is_array($bookingCustomField['value'])
                                    ? '; ' . implode('; ', $bookingCustomField['value']) :
                                    '; ' . $bookingCustomField['value'];
                            } else {
                                $customFieldsData['custom_field_' . $bookingCustomFieldKey] =
                                    is_array($bookingCustomField['value'])
                                        ? implode('; ', $bookingCustomField['value']) : $bookingCustomField['value'];
                            }

                            $bookingCustomFieldsKeys[(int)$bookingCustomFieldKey] = true;
                        }
                    }
                }
            }
        } else {
            $bookingCustomFields = json_decode($appointment['bookings'][$bookingKey]['customFields'], true);

            if ($bookingCustomFields) {
                foreach ((array)$bookingCustomFields as $bookingCustomFieldKey => $bookingCustomField) {
                    $bookingCustomFieldsKeys[(int)$bookingCustomFieldKey] = true;

                    if (is_array($bookingCustomField) && array_key_exists('type', $bookingCustomField) && $bookingCustomField['type'] === 'file') {
                        continue;
                    }

                    $customFieldsData['custom_field_' . $bookingCustomFieldKey] = is_array($bookingCustomField['value'])
                        ? implode('; ', $bookingCustomField['value']) : $bookingCustomField['value'];
                }
            }
        }

        /** @var CustomFieldRepository $customFieldRepository */
        $customFieldRepository = $this->container->get('domain.customField.repository');

        /** @var Collection $customFields */
        $customFields = $customFieldRepository->getAll();

        /** @var CustomField $customField */
        foreach ($customFields->getItems() as $customField) {
            if (!array_key_exists($customField->getId()->getValue(), $bookingCustomFieldsKeys)) {
                $customFieldsData['custom_field_' . $customField->getId()->getValue()] = '';
            }
        }

        return $customFieldsData;
    }

    /**
     * @param array  $appointment
     * @param string $type
     * @param null   $bookingKey
     *
     * @return array
     * @throws ContainerException
     * @throws QueryExecutionException
     * @throws InvalidArgumentException
     */
    private function getCouponsData($appointment, $type, $bookingKey = null)
    {
        $couponsData = [];

        /** @var string $break */
        $break = $type === 'email' ? '<br>' : PHP_EOL;

        if ($bookingKey !== null) {
            /** @var HelperService $helperService */
            $helperService = $this->container->get('application.helper.service');

            /** @var CouponRepository $couponRepository */
            $couponRepository = $this->container->get('domain.coupon.repository');

            /** @var CouponApplicationService $couponAS */
            $couponAS = $this->container->get('application.coupon.service');

            /** @var Collection $customerReservations */
            $customerReservations = new Collection();

            $type = $appointment['type'];
            $customerId = $appointment['bookings'][$bookingKey]['customerId'];
            $entityId = null;
            $couponsCriteria = [];

            switch ($type) {
                case Entities::APPOINTMENT:
                    /** @var AppointmentRepository $appointmentRepository */
                    $appointmentRepository = $this->container->get('domain.booking.appointment.repository');

                    $entityId = $appointment['serviceId'];
                    $couponsCriteria['serviceId'] = $entityId;

                    $customerReservations = $appointmentRepository->getFiltered([
                        'customerId'    => $customerId,
                        'status'        => BookingStatus::APPROVED,
                        'bookingStatus' => BookingStatus::APPROVED,
                        'services'      => [
                            $entityId
                        ]
                    ]);

                    break;

                case Entities::EVENT:
                    /** @var EventRepository $eventRepository */
                    $eventRepository = $this->container->get('domain.booking.event.repository');

                    $entityId = $appointment['id'];
                    $couponsCriteria['eventId'] = $entityId;

                    $customerReservations = $eventRepository->getFiltered([
                        'customerId'    => $customerId,
                        'bookingStatus' => BookingStatus::APPROVED,
                    ]);

                    break;
            }

            /** @var Collection $entityCoupons */
            $entityCoupons = $couponRepository->getAllByCriteria($couponsCriteria);

            /** @var Collection $allCoupons */
            $allCoupons = $couponRepository->getAllIndexedById();

            foreach (array_diff($allCoupons->keys(), $entityCoupons->keys()) as $couponId) {
                $couponsData["coupon_{$couponId}"] = '';
            }

            /** @var Coupon $coupon */
            foreach ($entityCoupons->getItems() as $coupon) {
                /** @var Collection $reservationsForCheck */
                $reservationsForCheck = new Collection();

                switch ($type) {
                    case Entities::APPOINTMENT:
                        $reservationsForCheck = $customerReservations;

                        break;

                    case Entities::EVENT:
                        /** @var Event $reservation */
                        foreach ($customerReservations->getItems() as $reservation) {
                            if ($coupon->getEventList()->keyExists($reservation->getId()->getValue())) {
                                $reservationsForCheck->addItem($reservation, $reservation->getId()->getValue());
                            }
                        }

                        break;
                }

                $sendCoupon = (
                        !$coupon->getNotificationRecurring()->getValue() &&
                        $reservationsForCheck->length() === $coupon->getNotificationInterval()->getValue()
                    ) || (
                        $coupon->getNotificationRecurring()->getValue() &&
                        $reservationsForCheck->length() % $coupon->getNotificationInterval()->getValue() === 0
                    );

                try {
                    if ($sendCoupon && $couponAS->inspectCoupon($coupon, $entityId, $type, $customerId, true)) {
                        $couponsData["coupon_{$coupon->getId()->getValue()}"] =
                            FrontendStrings::getCommonStrings()['coupon_send_text'] .
                            $coupon->getCode()->getValue() . $break .
                            ($coupon->getDeduction() && $coupon->getDeduction()->getValue() ?
                                BackendStrings::getFinanceStrings()['deduction'] . ' ' .
                                $helperService->getFormattedPrice($coupon->getDeduction()->getValue()) . $break
                                : ''
                            ) .
                            ($coupon->getDiscount() && $coupon->getDiscount()->getValue() ?
                                BackendStrings::getPaymentStrings()['discount_amount'] . ' ' .
                                $coupon->getDiscount()->getValue() . '%'
                                : '');
                    } else {
                        $couponsData["coupon_{$coupon->getId()->getValue()}"] = '';
                    }
                } catch (CouponUnknownException $e) {
                    $couponsData["coupon_{$coupon->getId()->getValue()}"] = '';
                } catch (CouponInvalidException $e) {
                    $couponsData["coupon_{$coupon->getId()->getValue()}"] = '';
                }
            }
        }

        return $couponsData;
    }
}
