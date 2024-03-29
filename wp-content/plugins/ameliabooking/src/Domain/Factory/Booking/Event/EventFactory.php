<?php
/**
 * @copyright © TMS-Plugins. All rights reserved.
 * @licence   See LICENCE.md for license details.
 */

namespace AmeliaBooking\Domain\Factory\Booking\Event;

use AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException;
use AmeliaBooking\Domain\Entity\Booking\Event\Event;
use AmeliaBooking\Domain\Entity\Entities;
use AmeliaBooking\Domain\Entity\Gallery\GalleryImage;
use AmeliaBooking\Domain\Factory\Booking\Appointment\CustomerBookingFactory;
use AmeliaBooking\Domain\Factory\Coupon\CouponFactory;
use AmeliaBooking\Domain\Factory\User\ProviderFactory;
use AmeliaBooking\Domain\Services\DateTime\DateTimeService;
use AmeliaBooking\Domain\ValueObjects\BooleanValueObject;
use AmeliaBooking\Domain\ValueObjects\DateTime\DateTimeValue;
use AmeliaBooking\Domain\ValueObjects\Json;
use AmeliaBooking\Domain\ValueObjects\Number\Float\Price;
use AmeliaBooking\Domain\ValueObjects\Number\Integer\IntegerValue;
use AmeliaBooking\Domain\ValueObjects\Number\Integer\PositiveInteger;
use AmeliaBooking\Domain\ValueObjects\Picture;
use AmeliaBooking\Domain\ValueObjects\String\BookingStatus;
use AmeliaBooking\Domain\ValueObjects\Number\Integer\Id;
use AmeliaBooking\Domain\Collection\Collection;
use AmeliaBooking\Domain\ValueObjects\String\Color;
use AmeliaBooking\Domain\ValueObjects\String\Description;
use AmeliaBooking\Domain\ValueObjects\String\EntityType;
use AmeliaBooking\Domain\ValueObjects\String\Name;

/**
 * Class EventFactory
 *
 * @package AmeliaBooking\Domain\Factory\Booking\Event
 */
class EventFactory
{

    /**
     * @param $data
     *
     * @return Event
     * @throws InvalidArgumentException
     */
    public static function create($data)
    {
        $event = new Event(
            new Name($data['name']),
            new Price($data['price'])
        );

        if (isset($data['id'])) {
            $event->setId(new Id($data['id']));
        }

        if (isset($data['parentId'])) {
            $event->setParentId(new Id($data['parentId']));
        }

        if (!empty($data['bookingOpens'])) {
            $event->setBookingOpens(new DateTimeValue(DateTimeService::getCustomDateTimeObject($data['bookingOpens'])));
        }

        if (!empty($data['bookingCloses'])) {
            $event->setBookingCloses(new DateTimeValue(DateTimeService::getCustomDateTimeObject($data['bookingCloses'])));
        }

        if (isset($data['notifyParticipants'])) {
            $event->setNotifyParticipants($data['notifyParticipants']);
        }

        if (isset($data['status'])) {
            $event->setStatus(new BookingStatus($data['status']));
        }

        if (isset($data['recurring']['cycle'], $data['recurring']['until'])) {
            $event->setRecurring(RecurringFactory::create($data['recurring']));
        }

        if (isset($data['maxCapacity'])) {
            $event->setMaxCapacity(new IntegerValue($data['maxCapacity']));
        }

        if (isset($data['description'])) {
            $event->setDescription(new Description($data['description']));
        }

        if (!empty($data['locationId'])) {
            $event->setLocationId(new Id($data['locationId']));
        }

        if (!empty($data['customLocation'])) {
            $event->setCustomLocation(new Name($data['customLocation']));
        }

        if (isset($data['color'])) {
            $event->setColor(new Color($data['color']));
        }

        if (isset($data['show'])) {
            $event->setShow(new BooleanValueObject($data['show']));
        }

        if (isset($data['created'])) {
            $event->setCreated(new DateTimeValue(DateTimeService::getCustomDateTimeObject($data['created'])));
        }

        if (!empty($data['settings'])) {
            $event->setSettings(new Json($data['settings']));
        }

        $tags = new Collection();

        if (isset($data['tags'])) {
            foreach ((array)$data['tags'] as $key => $value) {
                $tags->addItem(
                    EventTagFactory::create($value),
                    $key
                );
            }
        }

        $event->setTags($tags);

        $bookings = new Collection();

        if (isset($data['bookings'])) {
            foreach ((array)$data['bookings'] as $key => $value) {
                $bookings->addItem(
                    CustomerBookingFactory::create($value),
                    $key
                );
            }
        }

        $event->setBookings($bookings);

        $periods = new Collection();

        if (isset($data['periods'])) {
            foreach ((array)$data['periods'] as $key => $value) {
                $periods->addItem(EventPeriodFactory::create($value));
            }
        }

        $event->setPeriods($periods);

        $gallery = new Collection();

        if (!empty($data['gallery'])) {
            foreach ((array)$data['gallery'] as $image) {
                $galleryImage = new GalleryImage(
                    new EntityType(Entities::EVENT),
                    new Picture($image['pictureFullPath'], $image['pictureThumbPath']),
                    new PositiveInteger($image['position'])
                );

                if (!empty($image['id'])) {
                    $galleryImage->setId(new Id($image['id']));
                }

                if ($event->getId()) {
                    $galleryImage->setEntityId($event->getId());
                }

                $gallery->addItem($galleryImage);
            }
        }

        $event->setGallery($gallery);

        $coupons = new Collection();

        if (!empty($data['coupons'])) {
            /** @var array $couponsList */
            $couponsList = $data['coupons'];

            foreach ($couponsList as $couponKey => $coupon) {
                $coupons->addItem(CouponFactory::create($coupon), $couponKey);
            }
        }

        $event->setCoupons($coupons);

        $providers = new Collection();

        if (!empty($data['providers'])) {
            /** @var array $providerList */
            $providerList = $data['providers'];

            foreach ($providerList as $providerKey => $provider) {
                $providers->addItem(ProviderFactory::create($provider), $providerKey);
            }
        }

        $event->setProviders($providers);

        if (!empty($data['zoomUserId'])) {
            $event->setZoomUserId(new Name($data['zoomUserId']));
        }

        return $event;
    }

    /**
     * @param array $rows
     *
     * @return Collection
     * @throws InvalidArgumentException
     */
    public static function createCollection($rows)
    {
        $events = [];

        foreach ($rows as $row) {
            $eventId = $row['event_id'];
            $eventPeriodId = isset($row['event_periodId']) ? $row['event_periodId'] : null;
            $galleryId = isset($row['gallery_id']) ? $row['gallery_id'] : null;
            $customerId = isset($row['customer_id']) ? $row['customer_id'] : null;
            $bookingId = isset($row['booking_id']) ? $row['booking_id'] : null;
            $paymentId = isset($row['payment_id']) ? $row['payment_id'] : null;
            $tagId = isset($row['event_tagId']) ? $row['event_tagId'] : null;
            $providerId = isset($row['provider_id']) ? $row['provider_id'] : null;
            $couponId = isset($row['coupon_id']) ? $row['coupon_id'] : null;

            if (!array_key_exists($eventId, $events)) {
                $events[$eventId] = [
                    'id'                    => $eventId,
                    'name'                  => $row['event_name'],
                    'status'                => $row['event_status'],
                    'bookingOpens'          => $row['event_bookingOpens'] ?
                        DateTimeService::getCustomDateTimeFromUtc($row['event_bookingOpens']) : null,
                    'bookingCloses'         => $row['event_bookingCloses'] ?
                        DateTimeService::getCustomDateTimeFromUtc($row['event_bookingCloses']) : null,
                    'recurring'             => [
                        'cycle' => $row['event_recurringCycle'],
                        'order' => $row['event_recurringOrder'],
                        'until' => DateTimeService::getCustomDateTimeFromUtc($row['event_recurringUntil'])
                    ],
                    'maxCapacity'           => $row['event_maxCapacity'],
                    'price'                 => $row['event_price'],
                    'description'           => $row['event_description'],
                    'color'                 => $row['event_color'],
                    'show'                  => $row['event_show'],
                    'notifyParticipants'    => $row['event_notifyParticipants'],
                    'locationId'            => $row['event_locationId'],
                    'customLocation'        => $row['event_customLocation'],
                    'parentId'              => $row['event_parentId'],
                    'created'               => $row['event_created'],
                    'settings'              => isset($row['event_settings']) ? $row['event_settings'] : null,
                    'zoomUserId'            => isset($row['event_zoomUserId']) ? $row['event_zoomUserId'] : null
                ];
            }

            if ($galleryId) {
                $events[$eventId]['gallery'][$galleryId]['id'] = $row['gallery_id'];
                $events[$eventId]['gallery'][$galleryId]['pictureFullPath'] = $row['gallery_picture_full'];
                $events[$eventId]['gallery'][$galleryId]['pictureThumbPath'] = $row['gallery_picture_thumb'];
                $events[$eventId]['gallery'][$galleryId]['position'] = $row['gallery_position'];
            }

            if ($providerId) {
                $events[$eventId]['providers'][$providerId] =
                    [
                        'id'               => $providerId,
                        'firstName'        => $row['provider_firstName'],
                        'lastName'         => $row['provider_lastName'],
                        'email'            => $row['provider_email'],
                        'note'             => $row['provider_note'],
                        'phone'            => $row['provider_phone'],
                        'pictureFullPath'  =>
                            isset($row['provider_pictureFullPath']) ? $row['provider_pictureFullPath'] : null,
                        'pictureThumbPath' =>
                            isset($row['provider_pictureFullPath']) ? $row['provider_pictureThumbPath'] : null,
                        'type'             => 'provider',
                    ];
            }


            if ($eventPeriodId && !isset($events[$eventId]['periods'][$eventPeriodId])) {
                $zoomMeetingJson = !empty($row['event_periodZoomMeeting']) ?
                    json_decode($row['event_periodZoomMeeting'], true) : null;

                $events[$eventId]['periods'][$eventPeriodId] = [
                    'id'             => $eventPeriodId,
                    'eventId'        => $eventId,
                    'periodStart'    => DateTimeService::getCustomDateTimeFromUtc($row['event_periodStart']),
                    'periodEnd'      => DateTimeService::getCustomDateTimeFromUtc($row['event_periodEnd']),
                    'zoomMeeting'    => [
                        'id'       => $zoomMeetingJson ? $zoomMeetingJson['id'] : null,
                        'startUrl' => $zoomMeetingJson ? $zoomMeetingJson['startUrl'] : null,
                        'joinUrl'  => $zoomMeetingJson ? $zoomMeetingJson['joinUrl'] : null,
                    ],
                    'bookings'       => []
                ];
            }

            if ($tagId && !isset($events[$eventId]['tags'][$tagId])) {
                $events[$eventId]['tags'][$tagId] = [
                    'id'             => $tagId,
                    'eventId'        => $eventId,
                    'name'           => $row['event_tagName']
                ];
            }

            if ($bookingId && !isset($events[$eventId]['bookings'][$bookingId])) {
                $events[$eventId]['bookings'][$bookingId] = [
                    'id'            => $bookingId,
                    'appointmentId' => null,
                    'customerId'    => $row['booking_customerId'],
                    'status'        => $row['booking_status'],
                    'price'         => $row['booking_price'],
                    'persons'       => $row['booking_persons'],
                    'customFields'  => isset($row['booking_customFields']) ? $row['booking_customFields'] : null,
                    'info'          => isset($row['booking_info']) ? $row['booking_info'] : null,
                    'utcOffset'     => isset($row['booking_utcOffset']) ? $row['booking_utcOffset'] : null,
                    'aggregatedPrice' => isset($row['booking_aggregatedPrice']) ?
                        $row['booking_aggregatedPrice'] : null,
                    'token'         => isset($row['booking_token']) ? $row['booking_token'] : null,
                ];
            }

            if ($bookingId && !isset($events[$eventId]['periods'][$eventPeriodId]['bookings'][$bookingId])) {
                $events[$eventId]['periods'][$eventPeriodId]['bookings'][$bookingId] = [
                    'id'            => $bookingId,
                    'appointmentId' => null,
                    'customerId'    => $row['booking_customerId'],
                    'status'        => $row['booking_status'],
                    'price'         => $row['booking_price'],
                    'persons'       => $row['booking_persons'],
                    'customFields'  => isset($row['booking_customFields']) ? $row['booking_customFields'] : null,
                    'info'          => isset($row['booking_info']) ? $row['booking_info'] : null,
                    'utcOffset'     => isset($row['booking_utcOffset']) ? $row['booking_utcOffset'] : null
                ];
            }

            if ($bookingId && $paymentId) {
                $events[$eventId]['bookings'][$bookingId]['payments'][$paymentId] =
                    [
                        'id'                => $paymentId,
                        'customerBookingId' => $bookingId,
                        'status'            => $row['payment_status'],
                        'dateTime'          => DateTimeService::getCustomDateTimeFromUtc($row['payment_dateTime']),
                        'gateway'           => $row['payment_gateway'],
                        'gatewayTitle'      => $row['payment_gatewayTitle'],
                        'amount'            => $row['payment_amount'],
                        'data'              => $row['payment_data'],
                    ];
            }

            if ($bookingId && $customerId) {
                $events[$eventId]['bookings'][$bookingId]['customer'] =
                    [
                        'id'        => $customerId,
                        'firstName' => $row['customer_firstName'],
                        'lastName'  => $row['customer_lastName'],
                        'email'     => $row['customer_email'],
                        'note'      => $row['customer_note'],
                        'phone'     => $row['customer_phone'],
                        'gender'    => $row['customer_gender'],
                        'type'      => 'customer',
                    ];
            }

            if ($bookingId && $couponId) {
                $events[$eventId]['bookings'][$bookingId]['coupon']['id'] = $couponId;
                $events[$eventId]['bookings'][$bookingId]['coupon']['code'] = $row['coupon_code'];
                $events[$eventId]['bookings'][$bookingId]['coupon']['discount'] = $row['coupon_discount'];
                $events[$eventId]['bookings'][$bookingId]['coupon']['deduction'] = $row['coupon_deduction'];
                $events[$eventId]['bookings'][$bookingId]['coupon']['limit'] = $row['coupon_limit'];
                $events[$eventId]['bookings'][$bookingId]['coupon']['customerLimit'] = $row['coupon_customerLimit'];
                $events[$eventId]['bookings'][$bookingId]['coupon']['status'] = $row['coupon_status'];
            }

            if ($couponId) {
                $events[$eventId]['coupons'][$couponId]['id'] = $couponId;
                $events[$eventId]['coupons'][$couponId]['code'] = $row['coupon_code'];
                $events[$eventId]['coupons'][$couponId]['discount'] = $row['coupon_discount'];
                $events[$eventId]['coupons'][$couponId]['deduction'] = $row['coupon_deduction'];
                $events[$eventId]['coupons'][$couponId]['limit'] = $row['coupon_limit'];
                $events[$eventId]['coupons'][$couponId]['customerLimit'] = $row['coupon_customerLimit'];
                $events[$eventId]['coupons'][$couponId]['status'] = $row['coupon_status'];
            }
        }

        $collection = new Collection();

        foreach ($events as $key => $value) {
            $collection->addItem(
                self::create($value),
                $key
            );
        }

        return $collection;
    }
}
