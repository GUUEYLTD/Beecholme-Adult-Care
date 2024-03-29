<?php

namespace AmeliaBooking\Infrastructure\Repository\Booking\Event;

use AmeliaBooking\Domain\Collection\Collection;
use AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException;
use AmeliaBooking\Domain\Entity\Booking\Event\Event;
use AmeliaBooking\Domain\Factory\Booking\Event\EventFactory;
use AmeliaBooking\Domain\Repository\Booking\Event\EventRepositoryInterface;
use AmeliaBooking\Domain\Services\DateTime\DateTimeService;
use AmeliaBooking\Domain\ValueObjects\String\Status;
use AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException;
use AmeliaBooking\Infrastructure\Repository\AbstractRepository;
use AmeliaBooking\Infrastructure\WP\InstallActions\DB\Booking\CustomerBookingsTable;
use AmeliaBooking\Infrastructure\WP\InstallActions\DB\Booking\CustomerBookingsToEventsPeriodsTable;
use AmeliaBooking\Infrastructure\WP\InstallActions\DB\Booking\EventsPeriodsTable;
use AmeliaBooking\Infrastructure\WP\InstallActions\DB\Booking\EventsProvidersTable;
use AmeliaBooking\Infrastructure\WP\InstallActions\DB\Booking\EventsTagsTable;
use AmeliaBooking\Infrastructure\WP\InstallActions\DB\Coupon\CouponsTable;
use AmeliaBooking\Infrastructure\WP\InstallActions\DB\Coupon\CouponsToEventsTable;
use AmeliaBooking\Infrastructure\WP\InstallActions\DB\Gallery\GalleriesTable;
use AmeliaBooking\Infrastructure\WP\InstallActions\DB\Payment\PaymentsTable;
use AmeliaBooking\Infrastructure\WP\InstallActions\DB\User\UsersTable;

/**
 * Class EventRepository
 *
 * @package AmeliaBooking\Infrastructure\Repository\Booking\Event
 */
class EventRepository extends AbstractRepository implements EventRepositoryInterface
{

    const FACTORY = EventFactory::class;

    /**
     * @param Event $entity
     *
     * @return bool
     * @throws QueryExecutionException
     */
    public function add($entity)
    {
        $data = $entity->toArray();

        $params = [
            ':bookingOpens'         => $data['bookingOpens'] ? DateTimeService::getCustomDateTimeInUtc($data['bookingOpens']) : null,
            ':bookingCloses'        => $data['bookingCloses'] ? DateTimeService::getCustomDateTimeInUtc($data['bookingCloses']) : null,
            ':status'               => $data['status'],
            ':name'                 => $data['name'],
            ':description'          => $data['description'],
            ':color'                => $data['color'],
            ':price'                => $data['price'],
            ':recurringCycle'       => $data['recurring'] && $data['recurring']['cycle'] ?
                $data['recurring']['cycle'] : null,
            ':recurringOrder'       => $data['recurring'] && $data['recurring']['order'] ?
                $data['recurring']['order'] : null,
            ':recurringUntil'       => $data['recurring'] && $data['recurring']['until'] ?
                DateTimeService::getCustomDateTimeInUtc($data['recurring']['until']) : null,
            ':maxCapacity'          => $data['maxCapacity'],
            ':show'                 => $data['show'] ? 1 : 0,
            ':notifyParticipants'   => $data['notifyParticipants'],
            ':locationId'           => $data['locationId'],
            ':customLocation'       => $data['customLocation'],
            ':parentId'             => $data['parentId'],
            ':created'              => $data['created'],
            ':settings'             => $data['settings'],
            ':zoomUserId'           => $data['zoomUserId'],
        ];

        try {
            $statement = $this->connection->prepare(
                "INSERT INTO {$this->table} 
                (
                `bookingOpens`,
                `bookingCloses`,
                `status`,
                `name`,
                `description`,
                `color`,
                `price`,
                `recurringCycle`,
                `recurringOrder`,
                `recurringUntil`,
                `maxCapacity`,
                `show`,
                `notifyParticipants`,
                `locationId`,
                `customLocation`,
                `parentId`,
                `created`,
                `settings`,
                `zoomUserId`
                )
                VALUES (
                :bookingOpens,
                :bookingCloses,
                :status,
                :name,
                :description,
                :color,
                :price,
                :recurringCycle,
                :recurringOrder,
                :recurringUntil,
                :maxCapacity,
                :show,
                :notifyParticipants,
                :locationId,
                :customLocation,
                :parentId,
                :created,
                :settings,
                :zoomUserId
                )"
            );

            $res = $statement->execute($params);

            if (!$res) {
                throw new QueryExecutionException('Unable to add data in ' . __CLASS__);
            }

            return $this->connection->lastInsertId();
        } catch (\Exception $e) {
            throw new QueryExecutionException('Unable to add data in ' . __CLASS__, $e->getCode(), $e);
        }
    }

    /**
     * @param int         $id
     * @param Event $entity
     *
     * @return mixed
     * @throws QueryExecutionException
     */
    public function update($id, $entity)
    {
        $data = $entity->toArray();

        $params = [
            ':id'                   => $id,
            ':bookingOpens'         => $data['bookingOpens'] ? DateTimeService::getCustomDateTimeInUtc($data['bookingOpens']) : null,
            ':bookingCloses'        => $data['bookingCloses'] ? DateTimeService::getCustomDateTimeInUtc($data['bookingCloses']) : null,
            ':status'               => $data['status'],
            ':name'                 => $data['name'],
            ':description'          => $data['description'],
            ':color'                => $data['color'],
            ':price'                => $data['price'],
            ':recurringCycle'       => $data['recurring'] ? $data['recurring']['cycle'] : null,
            ':recurringOrder'       => $data['recurring'] ? $data['recurring']['order'] : null,
            ':recurringUntil'       => $data['recurring'] ?
                DateTimeService::getCustomDateTimeInUtc($data['recurring']['until']) : null,
            ':maxCapacity'          => $data['maxCapacity'],
            ':show'                 => $data['show'] ? 1 : 0,
            ':notifyParticipants'   => $data['notifyParticipants'],
            ':locationId'           => $data['locationId'],
            ':customLocation'       => $data['customLocation'],
            ':parentId'             => $data['parentId'],
            ':settings'             => $data['settings'],
            ':zoomUserId'           => $data['zoomUserId'],
        ];

        try {
            $statement = $this->connection->prepare(
                "UPDATE {$this->table}
                SET
                `bookingOpens` = :bookingOpens,
                `bookingCloses` = :bookingCloses, 
                `status` = :status,
                `name` = :name,
                `description` = :description,
                `color` = :color,
                `price` = :price,
                `recurringCycle` = :recurringCycle,
                `recurringOrder` = :recurringOrder,
                `recurringUntil` = :recurringUntil,
                `maxCapacity` = :maxCapacity,
                `show` = :show,
                `notifyParticipants` = :notifyParticipants,
                `locationId` = :locationId,
                `customLocation` = :customLocation,
                `parentId` = :parentId,
                `settings` = :settings,
                `zoomUserId` = :zoomUserId
                WHERE id = :id"
            );

            $res = $statement->execute($params);

            if (!$res) {
                throw new QueryExecutionException('Unable to save data in ' . __CLASS__);
            }

            return $res;
        } catch (\Exception $e) {
            throw new QueryExecutionException('Unable to save data in ' . __CLASS__, $e->getCode(), $e);
        }
    }

    /**
     * @param int $id
     * @param int $status
     *
     * @return mixed
     * @throws QueryExecutionException
     */
    public function updateStatusById($id, $status)
    {
        $params = [
            ':id'     => $id,
            ':status' => $status
        ];

        try {
            $statement = $this->connection->prepare(
                "UPDATE {$this->table}
                SET
                `status` = :status
                WHERE id = :id"
            );

            $res = $statement->execute($params);

            if (!$res) {
                throw new QueryExecutionException('Unable to save data in ' . __CLASS__);
            }

            return $res;
        } catch (\Exception $e) {
            throw new QueryExecutionException('Unable to save data in ' . __CLASS__, $e->getCode(), $e);
        }
    }

    /**
     * @param int $id
     * @param int $parentId
     *
     * @return mixed
     * @throws QueryExecutionException
     */
    public function updateParentId($id, $parentId)
    {
        $params = [
            ':id'             => $id,
            ':parentId'       => $parentId,
        ];

        try {
            $statement = $this->connection->prepare(
                "UPDATE {$this->table}
                SET
                `parentId` = :parentId
                WHERE id = :id"
            );

            $res = $statement->execute($params);

            if (!$res) {
                throw new QueryExecutionException('Unable to save data in ' . __CLASS__);
            }

            return $res;
        } catch (\Exception $e) {
            throw new QueryExecutionException('Unable to save data in ' . __CLASS__, $e->getCode(), $e);
        }
    }

    /**
     * @param array $criteria
     *
     * @return Collection
     * @throws QueryExecutionException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     */
    public function getFiltered($criteria)
    {
        $eventsPeriodsTable = EventsPeriodsTable::getTableName();
        $eventsTagsTable = EventsTagsTable::getTableName();
        $galleriesTable = GalleriesTable::getTableName();
        $paymentsTable = PaymentsTable::getTableName();
        $customerBookingsEventsPeriods = CustomerBookingsToEventsPeriodsTable::getTableName();
        $customerBookingsTable = CustomerBookingsTable::getTableName();
        $eventsProvidersTable = EventsProvidersTable::getTableName();
        $usersTable = UsersTable::getTableName();

        $params = [];
        $where = [];

        if (!empty($criteria['ids'])) {
            $queryIds = [];

            foreach ((array)$criteria['ids'] as $index => $value) {
                $param = ':id' . $index;
                $queryIds[] = $param;
                $params[$param] = $value;
            }

            $where[] = 'e.id IN (' . implode(', ', $queryIds) . ')';
        }

        if (isset($criteria['parentId'])) {
            $params[':parentId'] = $criteria['parentId'];
            $params[':originParentId'] = $criteria['parentId'];

            $where[] = 'e.parentId = :parentId OR e.id = :originParentId';
        }

        if (isset($criteria['search'])) {
            $params[':search'] = "%{$criteria['search']}%";

            $where[] = 'e.name LIKE :search';
        }

        if (isset($criteria['status'])) {
            $params[':status'] = $criteria['status'];

            $where[] = 'e.status = :status';
        }

        if (!empty($criteria['dates'])) {
            if (isset($criteria['dates'][0], $criteria['dates'][1])) {
                $where[] = "(DATE_FORMAT(ep.periodStart, '%Y-%m-%d %H:%i:%s') BETWEEN :eventFrom AND :eventTo)";
                $params[':eventFrom'] = DateTimeService::getCustomDateTimeInUtc($criteria['dates'][0]);
                $params[':eventTo'] = DateTimeService::getCustomDateTimeInUtc($criteria['dates'][1]);
            } elseif (isset($criteria['dates'][0])) {
                $where[] = "(DATE_FORMAT(ep.periodStart, '%Y-%m-%d %H:%i:%s') >= :eventFrom)";
                $params[':eventFrom'] = DateTimeService::getCustomDateTimeInUtc($criteria['dates'][0]);
            } elseif (isset($criteria['dates'][1])) {
                $where[] = "(DATE_FORMAT(ep.periodStart, '%Y-%m-%d %H:%i:%s') <= :eventTo)";
                $params[':eventTo'] = DateTimeService::getCustomDateTimeInUtc($criteria['dates'][1]);
            } else {
                $where[] = "(DATE_FORMAT(ep.periodStart, '%Y-%m-%d %H:%i:%s') > :eventFrom)";
                $params[':eventFrom'] = DateTimeService::getNowDateTimeInUtc();
            }
        }

        if (!empty($criteria['locations'])) {
            $queryLocations = [];

            foreach ((array)$criteria['locations'] as $index => $value) {
                $param = ':location' . $index;
                $queryLocations[] = $param;
                $params[$param] = $value;
            }

            $where[] = 'e.locationId IN (' . implode(', ', $queryLocations) . ')';
        }

        $providerJoin = '';
        $providerFields = '';

        if (!empty($criteria['providers'])) {
            $providerJoin = "
            INNER JOIN {$eventsProvidersTable} epr ON epr.eventId = e.id
            INNER JOIN {$usersTable} pu ON pu.id = epr.userId";

            $queryProviders = [];

            $providerFields = '
                pu.id AS provider_id,
                pu.firstName AS provider_firstName,
                pu.lastName AS provider_lastName,
                pu.email AS provider_email,
                pu.note AS provider_note,
                pu.phone AS provider_phone,
                pu.gender AS provider_gender,
                pu.pictureFullPath AS provider_pictureFullPath,
                pu.pictureThumbPath AS provider_pictureThumbPath,
            ';

            foreach ((array)$criteria['providers'] as $index => $value) {
                $param = ':provider' . $index;
                $queryProviders[] = $param;
                $params[$param] = $value;
            }

            $where[] = 'epr.userId IN (' . implode(', ', $queryProviders) . ')';
        }

        if (isset($criteria['tag'])) {
            $params[':tag'] = $criteria['tag'];

            $tagJoin = "INNER JOIN {$eventsTagsTable} et ON et.eventId = e.id AND et.name = :tag";
        } else {
            $tagJoin = "LEFT JOIN {$eventsTagsTable} et ON et.eventId = e.id";
        }

        if (isset($criteria['bookingCouponId'])) {
            $where[] = "cb.couponId = {$criteria['bookingCouponId']}";
        }

        $paymentJoin = '';
        $paymentFields = '';

        if (!empty($criteria['fetchPayments'])) {
            $paymentFields = '
                p.id AS payment_id,
                p.amount AS payment_amount,
                p.dateTime AS payment_dateTime,
                p.status AS payment_status,
                p.gateway AS payment_gateway,
                p.gatewayTitle AS payment_gatewayTitle,
                p.data AS payment_data,
            ';

            $paymentJoin = "LEFT JOIN {$paymentsTable} p ON p.customerBookingId = cb.id";
        }

        $couponJoin = '';
        $couponFields = '';

        if (!empty($criteria['fetchCoupons'])) {
            $couponsTable = CouponsTable::getTableName();

            $couponFields = '
                c.id AS coupon_id,
                c.code AS coupon_code,
                c.discount AS coupon_discount,
                c.deduction AS coupon_deduction,
                c.limit AS coupon_limit,
                c.customerLimit AS coupon_customerLimit,
                c.status AS coupon_status,
            ';

            $couponJoin = "LEFT JOIN {$couponsTable} c ON c.id = cb.couponId";
        }

        if (!empty($criteria['customerId'])) {
            $params[':customerId'] = $criteria['customerId'];

            $where[] = 'cb.customerId = :customerId';
        }

        if (array_key_exists('bookingStatus', $criteria)) {
            $where[] = 'cb.status = :bookingStatus';
            $params[':bookingStatus'] = $criteria['bookingStatus'];
        }

        $where = $where ? 'WHERE ' . implode(' AND ', $where) : '';

        try {
            $statement = $this->connection->prepare(
                "SELECT
                    e.id AS event_id,
                    e.name AS event_name,
                    e.status AS event_status,
                    e.bookingOpens AS event_bookingOpens,
                    e.bookingCloses AS event_bookingCloses,
                    e.recurringCycle AS event_recurringCycle,
                    e.recurringOrder AS event_recurringOrder,
                    e.recurringUntil AS event_recurringUntil,
                    e.maxCapacity AS event_maxCapacity,
                    e.price AS event_price,
                    e.description AS event_description,
                    e.color AS event_color,
                    e.show AS event_show,
                    e.locationId AS event_locationId,
                    e.customLocation AS event_customLocation,
                    e.parentId AS event_parentId,
                    e.created AS event_created,
                    e.notifyParticipants AS event_notifyParticipants,
                    e.settings AS event_settings,
                    e.zoomUserId AS event_zoomUserId,
                    
                    ep.id AS event_periodId,
                    ep.periodStart AS event_periodStart,
                    ep.periodEnd AS event_periodEnd,
                    ep.zoomMeeting AS event_periodZoomMeeting,
                    
                    et.id AS event_tagId,
                    et.name AS event_tagName,
                    
                    cb.id AS booking_id,
                    cb.customerId AS booking_customerId,
                    cb.status AS booking_status,
                    cb.price AS booking_price,
                    cb.persons AS booking_persons,
                    cb.customFields AS booking_customFields,
                    cb.info AS booking_info,
                    cb.aggregatedPrice AS booking_aggregatedPrice,
                    cb.couponId AS booking_couponId,
       
                    cu.id AS customer_id,
                    cu.firstName AS customer_firstName,
                    cu.lastName AS customer_lastName,
                    cu.email AS customer_email,
                    cu.note AS customer_note,
                    cu.phone AS customer_phone,
                    cu.gender AS customer_gender,
                    
                    {$couponFields}
                    
                    {$paymentFields}
                    
                    {$providerFields}
                    
                    g.id AS gallery_id,
                    g.pictureFullPath AS gallery_picture_full,
                    g.pictureThumbPath AS gallery_picture_thumb,
                    g.position AS gallery_position
                FROM {$this->table} e
                INNER JOIN {$eventsPeriodsTable} ep ON ep.eventId = e.id
                LEFT JOIN {$customerBookingsEventsPeriods} cbe ON cbe.eventPeriodId = ep.id
                LEFT JOIN {$customerBookingsTable} cb ON cb.id = cbe.customerBookingId
                LEFT JOIN {$usersTable} cu ON cu.id = cb.customerId
                LEFT JOIN {$galleriesTable} g ON g.entityId = e.id AND g.entityType = 'event'
                {$providerJoin}
                {$couponJoin}
                {$paymentJoin}
                {$tagJoin}
                {$where}
                ORDER BY ep.periodStart"
            );

            $statement->execute($params);

            $rows = $statement->fetchAll();
        } catch (\Exception $e) {
            throw new QueryExecutionException('Unable to find by id in ' . __CLASS__, $e->getCode(), $e);
        }

        return call_user_func([static::FACTORY, 'createCollection'], $rows);
    }

    /**
     * @param array $criteria
     *
     * @return Collection
     * @throws QueryExecutionException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     */
    public function getProvidersEvents($criteria)
    {
        $eventsPeriodsTable = EventsPeriodsTable::getTableName();
        $eventsProvidersTable = EventsProvidersTable::getTableName();
        $usersTable = UsersTable::getTableName();

        $params = [];
        $where = [];

        if (!empty($criteria['dates'])) {
            if (isset($criteria['dates'][0], $criteria['dates'][1])) {
                $where[] = "(DATE_FORMAT(ep.periodStart, '%Y-%m-%d %H:%i:%s') BETWEEN :eventFrom AND :eventTo)";
                $params[':eventFrom'] = DateTimeService::getCustomDateTimeInUtc($criteria['dates'][0]);
                $params[':eventTo'] = DateTimeService::getCustomDateTimeInUtc($criteria['dates'][1]);
            } elseif (isset($criteria['dates'][0])) {
                $where[] = "(DATE_FORMAT(ep.periodStart, '%Y-%m-%d %H:%i:%s') >= :eventFrom)";
                $params[':eventFrom'] = DateTimeService::getCustomDateTimeInUtc($criteria['dates'][0]);
            } elseif (isset($criteria['dates'][1])) {
                $where[] = "(DATE_FORMAT(ep.periodStart, '%Y-%m-%d %H:%i:%s') <= :eventTo)";
                $params[':eventTo'] = DateTimeService::getCustomDateTimeInUtc($criteria['dates'][1]);
            } else {
                $where[] = "(DATE_FORMAT(ep.periodStart, '%Y-%m-%d %H:%i:%s') > :eventFrom)";
                $params[':eventFrom'] = DateTimeService::getNowDateTimeInUtc();
            }
        }

        if (!empty($criteria['providers'])) {
            $queryProviders = [];

            foreach ((array)$criteria['providers'] as $index => $value) {
                $param = ':provider' . $index;
                $queryProviders[] = $param;
                $params[$param] = $value;
            }

            $where[] = 'epr.userId IN (' . implode(', ', $queryProviders) . ')';
        }

        if (!empty($criteria['status'])) {
            $params[':status'] = $criteria['status'];

            $where[] = 'e.status = :status';
        }

        $where = $where ? 'WHERE ' . implode(' AND ', $where) : '';

        try {
            $statement = $this->connection->prepare(
                "SELECT
                    e.id AS event_id,
                    e.name AS event_name,
                    e.status AS event_status,
                    e.bookingOpens AS event_bookingOpens,
                    e.bookingCloses AS event_bookingCloses,
                    e.recurringCycle AS event_recurringCycle,
                    e.recurringOrder AS event_recurringOrder,
                    e.recurringUntil AS event_recurringUntil,
                    e.maxCapacity AS event_maxCapacity,
                    e.price AS event_price,
                    e.description AS event_description,
                    e.color AS event_color,
                    e.show AS event_show,
                    e.locationId AS event_locationId,
                    e.customLocation AS event_customLocation,
                    e.parentId AS event_parentId,
                    e.created AS event_created,
                    e.notifyParticipants AS event_notifyParticipants,
                    
                    ep.id AS event_periodId,
                    ep.periodStart AS event_periodStart,
                    ep.periodEnd AS event_periodEnd,
                    
                    pu.id AS provider_id,
                    pu.firstName AS provider_firstName,
                    pu.lastName AS provider_lastName,
                    pu.email AS provider_email,
                    pu.note AS provider_note,
                    pu.phone AS provider_phone,
                    pu.gender AS provider_gender,
                    pu.pictureFullPath AS provider_pictureFullPath,
                    pu.pictureThumbPath AS provider_pictureThumbPath
                FROM {$this->table} e
                INNER JOIN {$eventsPeriodsTable} ep ON ep.eventId = e.id
                INNER JOIN {$eventsProvidersTable} epr ON epr.eventId = e.id
                INNER JOIN {$usersTable} pu ON pu.id = epr.userId
                {$where}
                ORDER BY ep.periodStart"
            );

            $statement->execute($params);

            $rows = $statement->fetchAll();
        } catch (\Exception $e) {
            throw new QueryExecutionException('Unable to find by id in ' . __CLASS__, $e->getCode(), $e);
        }

        return call_user_func([static::FACTORY, 'createCollection'], $rows);
    }

    /**
     * @param array $criteria
     * @param int   $itemsPerPage
     *
     * @return array
     * @throws QueryExecutionException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     */
    public function getFilteredIds($criteria, $itemsPerPage)
    {
        $eventsPeriodsTable = EventsPeriodsTable::getTableName();
        $eventsTagsTable = EventsTagsTable::getTableName();
        $customerBookingsTable = CustomerBookingsTable::getTableName();
        $customerBookingsEventsPeriods = CustomerBookingsToEventsPeriodsTable::getTableName();
        $eventsProvidersTable = EventsProvidersTable::getTableName();
        $usersTable = UsersTable::getTableName();

        $params = [];
        $limit = '';

        if (isset($criteria['page'])) {
            $params = [
                ':startingLimit' => ($criteria['page'] - 1) * $itemsPerPage,
                ':itemsPerPage'  => $itemsPerPage
            ];

            $limit = 'LIMIT :startingLimit, :itemsPerPage';
        }

        $where = [];

        if (isset($criteria['show'])) {
            $where = ['e.show = 1'];
        }

        if (!empty($criteria['dates'])) {
            if (isset($criteria['dates'][0], $criteria['dates'][1])) {
                $where[] = "(DATE_FORMAT(ep.periodStart, '%Y-%m-%d %H:%i:%s') BETWEEN :eventFrom AND :eventTo)";
                $params[':eventFrom'] = DateTimeService::getCustomDateTimeInUtc($criteria['dates'][0]);
                $params[':eventTo'] = DateTimeService::getCustomDateTimeInUtc($criteria['dates'][1]);
            } elseif (isset($criteria['dates'][0])) {
                $where[] = "(DATE_FORMAT(ep.periodStart, '%Y-%m-%d %H:%i:%s') >= :eventFrom)";
                $params[':eventFrom'] = DateTimeService::getCustomDateTimeInUtc($criteria['dates'][0]);
            } elseif (isset($criteria['dates'][1])) {
                $where[] = "(DATE_FORMAT(ep.periodStart, '%Y-%m-%d %H:%i:%s') <= :eventTo)";
                $params[':eventTo'] = DateTimeService::getCustomDateTimeInUtc($criteria['dates'][1]);
            } else {
                $where[] = "(DATE_FORMAT(ep.periodStart, '%Y-%m-%d %H:%i:%s') > :eventFrom)";
                $params[':eventFrom'] = DateTimeService::getNowDateTimeInUtc();
            }
        }

        $tagJoin = '';

        if (isset($criteria['tag'])) {
            $params[':tag'] = $criteria['tag'];

            $tagJoin = "INNER JOIN {$eventsTagsTable} et ON et.eventId = e.id AND et.name = :tag";
        }

        if (isset($criteria['id'])) {
            if ($criteria['recurring']) {
                $params[':id1'] = $criteria['id'];
                $params[':id2'] = $criteria['id'];
                $params[':id3'] = $criteria['id'];
                $params[':id4'] = $criteria['id'];

                $where[] = "(e.id = :id1 AND e.parentId IS NULL) OR 
                    (e.parentId IN (SELECT parentId FROM {$this->table} WHERE parentId = :id2)) OR
                    (e.id >= :id3  AND e.parentId IN (SELECT parentId FROM {$this->table} WHERE id = :id4))";
            } else {
                $params[':id'] = $criteria['id'];

                $where[] = 'e.id = :id';
            }
        }

        $customerJoin = '';

        if (!empty($criteria['customerId'])) {
            $customerJoin = "
            LEFT JOIN {$customerBookingsEventsPeriods} cbe ON cbe.eventPeriodId = ep.id
            LEFT JOIN {$customerBookingsTable} cb ON cb.id = cbe.customerBookingId";

            $params[':customerId'] = $criteria['customerId'];

            $where[] = 'cb.customerId = :customerId';
        }

        $providerJoin = '';

        if (!empty($criteria['providers'])) {
            $providerJoin = "
            INNER JOIN {$eventsProvidersTable} epr ON epr.eventId = e.id
            INNER JOIN {$usersTable} pu ON pu.id = epr.userId";

            $queryProviders = [];

            foreach ((array)$criteria['providers'] as $index => $value) {
                $param = ':provider' . $index;
                $queryProviders[] = $param;
                $params[$param] = $value;
            }

            $where[] = 'epr.userId IN (' . implode(', ', $queryProviders) . ')';
        }

        $where = $where ? 'WHERE ' . implode(' AND ', $where) : '';

        try {
            $statement = $this->connection->prepare(
                "SELECT
                     e.id
                FROM {$this->table} e
                INNER JOIN {$eventsPeriodsTable} ep ON ep.eventId = e.id
                {$tagJoin}
                {$providerJoin}
                {$customerJoin}
                {$where}
                GROUP BY e.id
                ORDER BY ep.periodStart
                {$limit}
                "
            );

            $statement->execute($params);

            $rows = $statement->fetchAll();
        } catch (\Exception $e) {
            throw new QueryExecutionException('Unable to find by id in ' . __CLASS__, $e->getCode(), $e);
        }

        return $rows;
    }

    /**
     * @param array $criteria
     *
     * @return int
     * @throws QueryExecutionException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     */
    public function getFilteredIdsCount($criteria)
    {
        $eventsPeriodsTable = EventsPeriodsTable::getTableName();
        $eventsTagsTable = EventsTagsTable::getTableName();

        $where = [];
        $params = [];

        if (!empty($criteria['dates'])) {
            if (isset($criteria['dates'][0], $criteria['dates'][1])) {
                $where[] = "(DATE_FORMAT(ep.periodStart, '%Y-%m-%d %H:%i:%s') BETWEEN :eventFrom AND :eventTo)";
                $params[':eventFrom'] = DateTimeService::getCustomDateTimeInUtc($criteria['dates'][0]);
                $params[':eventTo'] = DateTimeService::getCustomDateTimeInUtc($criteria['dates'][1]);
            } elseif (isset($criteria['dates'][0])) {
                $where[] = "(DATE_FORMAT(ep.periodStart, '%Y-%m-%d %H:%i:%s') >= :eventFrom)";
                $params[':eventFrom'] = DateTimeService::getCustomDateTimeInUtc($criteria['dates'][0]);
            } elseif (isset($criteria['dates'][1])) {
                $where[] = "(DATE_FORMAT(ep.periodStart, '%Y-%m-%d %H:%i:%s') <= :eventTo)";
                $params[':eventTo'] = DateTimeService::getCustomDateTimeInUtc($criteria['dates'][1]);
            } else {
                $where[] = "(DATE_FORMAT(ep.periodStart, '%Y-%m-%d %H:%i:%s') > :eventFrom)";
                $params[':eventFrom'] = DateTimeService::getNowDateTimeInUtc();
            }
        }

        $tagJoin = '';

        if (isset($criteria['tag'])) {
            $params[':tag'] = $criteria['tag'];

            $tagJoin = "INNER JOIN {$eventsTagsTable} et ON et.eventId = e.id AND et.name = :tag";
        }

        if (isset($criteria['id'])) {
            if ($criteria['recurring']) {
                $params[':id1'] = $criteria['id'];
                $params[':id2'] = $criteria['id'];
                $params[':id3'] = $criteria['id'];
                $params[':id4'] = $criteria['id'];

                $where[] = "(e.id = :id1 AND e.parentId IS NULL) OR 
                    (e.parentId IN (SELECT parentId FROM {$this->table} WHERE parentId = :id2)) OR
                    (e.id >= :id3  AND e.parentId IN (SELECT parentId FROM {$this->table} WHERE id = :id4))";
            } else {
                $params[':id'] = $criteria['id'];

                $where[] = 'e.id = :id';
            }
        }

        $where = $where ? 'WHERE ' . implode(' AND ', $where) : '';

        try {
            $statement = $this->connection->prepare(
                "SELECT e.id
                FROM {$this->table} e
                INNER JOIN {$eventsPeriodsTable} ep ON ep.eventId = e.id
                {$tagJoin}
                {$where}
                GROUP BY e.id
                ORDER BY ep.periodStart"
            );

            $statement->execute($params);

            $rows = $statement->fetchAll();
        } catch (\Exception $e) {
            throw new QueryExecutionException('Unable to find by id in ' . __CLASS__, $e->getCode(), $e);
        }

        return sizeOf($rows);
    }

    /**
     * @param int $id
     *
     * @return Event
     * @throws QueryExecutionException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     */
    public function getById($id)
    {
        $eventsPeriodsTable = EventsPeriodsTable::getTableName();
        $eventsTagsTable = EventsTagsTable::getTableName();

        $customerBookingsTable = CustomerBookingsTable::getTableName();
        $paymentsTable = PaymentsTable::getTableName();
        $usersTable = UsersTable::getTableName();
        $customerBookingsEventsPeriods = CustomerBookingsToEventsPeriodsTable::getTableName();
        $galleriesTable = GalleriesTable::getTableName();
        $eventsProvidersTable = EventsProvidersTable::getTableName();
        $couponsTable = CouponsTable::getTableName();

        try {
            $statement = $this->connection->prepare(
                "SELECT
                    e.id AS event_id,
                    e.name AS event_name,
                    e.status AS event_status,
                    e.bookingOpens AS event_bookingOpens,
                    e.bookingCloses AS event_bookingCloses,
                    e.recurringCycle AS event_recurringCycle,
                    e.recurringOrder AS event_recurringOrder,
                    e.recurringUntil AS event_recurringUntil,
                    e.maxCapacity AS event_maxCapacity,
                    e.price AS event_price,
                    e.description AS event_description,
                    e.color AS event_color,
                    e.show AS event_show,
                    e.notifyParticipants AS event_notifyParticipants,
                    e.locationId AS event_locationId,
                    e.customLocation AS event_customLocation,
                    e.parentId AS event_parentId,
                    e.created AS event_created,
                    e.settings AS event_settings,
                    e.zoomUserId AS event_zoomUserId,
                    
                    ep.id AS event_periodId,
                    ep.periodStart AS event_periodStart,
                    ep.periodEnd AS event_periodEnd,
                    ep.zoomMeeting AS event_periodZoomMeeting,
                    
                    et.id AS event_tagId,
                    et.name AS event_tagName,
                                        
                    cb.id AS booking_id,
                    cb.customerId AS booking_customerId,
                    cb.status AS booking_status,
                    cb.price AS booking_price,
                    cb.persons AS booking_persons,
                    cb.customFields AS booking_customFields,
                    cb.info AS booking_info,
                    cb.aggregatedPrice AS booking_aggregatedPrice,
                    cb.token AS booking_token,
                    cb.utcOffset AS booking_utcOffset,
                    
                    cu.id AS customer_id,
                    cu.firstName AS customer_firstName,
                    cu.lastName AS customer_lastName,
                    cu.email AS customer_email,
                    cu.note AS customer_note,
                    cu.phone AS customer_phone,
                    cu.gender AS customer_gender,
                    
                    p.id AS payment_id,
                    p.amount AS payment_amount,
                    p.dateTime AS payment_dateTime,
                    p.status AS payment_status,
                    p.gateway AS payment_gateway,
                    p.gatewayTitle AS payment_gatewayTitle,
                    p.data AS payment_data,
                    
                    pu.id AS provider_id,
                    pu.firstName AS provider_firstName,
                    pu.lastName AS provider_lastName,
                    pu.email AS provider_email,
                    pu.note AS provider_note,
                    pu.phone AS provider_phone,
                    pu.gender AS provider_gender,
                    
                    g.id AS gallery_id,
                    g.pictureFullPath AS gallery_picture_full,
                    g.pictureThumbPath AS gallery_picture_thumb,
                    g.position AS gallery_position,
                    
                    c.id AS coupon_id,
                    c.code AS coupon_code,
                    c.discount AS coupon_discount,
                    c.deduction AS coupon_deduction,
                    c.limit AS coupon_limit,
                    c.customerLimit AS coupon_customerLimit,
                    c.status AS coupon_status
                FROM {$this->table} e
                INNER JOIN {$eventsPeriodsTable} ep ON ep.eventId = e.id
                LEFT JOIN {$eventsTagsTable} et ON et.eventId = e.id
                LEFT JOIN {$customerBookingsEventsPeriods} cbe ON cbe.eventPeriodId = ep.id
                LEFT JOIN {$customerBookingsTable} cb ON cb.id = cbe.customerBookingId
                LEFT JOIN {$usersTable} cu ON cu.id = cb.customerId
                LEFT JOIN {$eventsProvidersTable} epr ON epr.eventId = e.id
                LEFT JOIN {$usersTable} pu ON pu.id = epr.userId
                LEFT JOIN {$paymentsTable} p ON p.customerBookingId = cb.id
                LEFT JOIN {$galleriesTable} g ON g.entityId = e.id AND g.entityType = 'event'
                LEFT JOIN {$couponsTable} c ON c.id = cb.couponId
                
                WHERE e.id = :eventId"
            );

            $statement->bindParam(':eventId', $id);

            $statement->execute();

            $rows = $statement->fetchAll();
        } catch (\Exception $e) {
            throw new QueryExecutionException('Unable to find event by id in ' . __CLASS__, $e->getCode(), $e);
        }

        return call_user_func([static::FACTORY, 'createCollection'], $rows)->getItem($id);
    }

    /**
     * @param array $ids
     *
     * @return Event
     * @throws QueryExecutionException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     */
    public function getByBookingIds($ids)
    {
        $eventsPeriodsTable = EventsPeriodsTable::getTableName();

        $usersTable = UsersTable::getTableName();
        $customerBookingsTable = CustomerBookingsTable::getTableName();
        $customerBookingsEventsPeriods = CustomerBookingsToEventsPeriodsTable::getTableName();
        $eventsProvidersTable = EventsProvidersTable::getTableName();
        $couponsTable = CouponsTable::getTableName();

        $params = [];
        $where = [];

        foreach ($ids as $key => $id) {
            $params[":customerBookingId$key"] = $id;
            $where[] = "cb.id = :customerBookingId$key";
        }

        $where = $where ? 'WHERE ' . implode(' OR ', $where) : '';

        try {
            $statement = $this->connection->prepare(
                "SELECT
                    e.id AS event_id,
                    e.name AS event_name,
                    e.status AS event_status,
                    e.bookingOpens AS event_bookingOpens,
                    e.bookingCloses AS event_bookingCloses,
                    e.recurringCycle AS event_recurringCycle,
                    e.recurringOrder AS event_recurringOrder,
                    e.recurringUntil AS event_recurringUntil,
                    e.maxCapacity AS event_maxCapacity,
                    e.price AS event_price,
                    e.description AS event_description,
                    e.color AS event_color,
                    e.show AS event_show,
                    e.notifyParticipants AS event_notifyParticipants,
                    e.locationId AS event_locationId,
                    e.customLocation AS event_customLocation,
                    e.parentId AS event_parentId,
                    e.created AS event_created,
                    e.settings AS event_settings,
                    e.zoomUserId AS event_zoomUserId,
                    
                    ep.id AS event_periodId,
                    ep.periodStart AS event_periodStart,
                    ep.periodEnd AS event_periodEnd,
                    ep.zoomMeeting AS event_periodZoomMeeting,
                    
                    cb.id AS booking_id,
                    cb.appointmentId AS booking_appointmentId,
                    cb.customerId AS booking_customerId,
                    cb.status AS booking_status,
                    cb.price AS booking_price,
                    cb.persons AS booking_persons,
                    cb.persons AS booking_couponId,
                    cb.customFields AS booking_customFields,
                    cb.info AS booking_info,
                    cb.utcOffset AS booking_utcOffset,
                    cb.aggregatedPrice AS booking_aggregatedPrice,
                    
                    cu.id AS customer_id,
                    cu.firstName AS customer_firstName,
                    cu.lastName AS customer_lastName,
                    cu.email AS customer_email,
                    cu.note AS customer_note,
                    cu.phone AS customer_phone,
                    cu.gender AS customer_gender,
                    
                    pu.id AS provider_id,
                    pu.firstName AS provider_firstName,
                    pu.lastName AS provider_lastName,
                    pu.email AS provider_email,
                    pu.note AS provider_note,
                    pu.phone AS provider_phone,
                    pu.gender AS provider_gender,
                    
                    c.id AS coupon_id,
                    c.code AS coupon_code,
                    c.discount AS coupon_discount,
                    c.deduction AS coupon_deduction,
                    c.limit AS coupon_limit,
                    c.customerLimit AS coupon_customerLimit,
                    c.status AS coupon_status
                FROM {$this->table} e
                INNER JOIN {$eventsPeriodsTable} ep ON ep.eventId = e.id
                INNER JOIN {$customerBookingsEventsPeriods} cbe ON cbe.eventPeriodId = ep.id
                INNER JOIN {$customerBookingsTable} cb ON cb.id = cbe.customerBookingId
                INNER JOIN {$usersTable} cu ON cu.id = cb.customerId
                LEFT JOIN {$couponsTable} c ON c.id = cb.couponId
                LEFT JOIN {$eventsProvidersTable} epr ON epr.eventId = e.id
                LEFT JOIN {$usersTable} pu ON pu.id = epr.userId
                
                {$where}"
            );

            $statement->execute($params);

            $rows = $statement->fetchAll();
        } catch (\Exception $e) {
            throw new QueryExecutionException('Unable to find event by id in ' . __CLASS__, $e->getCode(), $e);
        }

        return call_user_func([static::FACTORY, 'createCollection'], $rows);
    }

    /**
     * @param      $criteria
     *
     * @return Collection
     * @throws InvalidArgumentException
     * @throws QueryExecutionException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     */
    public function getWithCoupons($criteria)
    {
        $couponToEventsTable = CouponsToEventsTable::getTableName();
        $couponsTable = CouponsTable::getTableName();

        $params = [];

        $where = [];

        foreach ((array)$criteria as $index => $value) {
            $params[':event' . $index] = $value['eventId'];

            if ($value['couponId']) {
                $params[':coupon' . $index] = $value['couponId'];
                $params[':couponStatus' . $index] = Status::VISIBLE;
            }

            $where[] = "(e.id = :event$index"
                . ($value['couponId'] ? " AND c.id = :coupon$index AND c.status = :couponStatus$index" : '') . ')';
        }

        $where = $where ? 'WHERE ' . implode(' OR ', $where) : '';

        try {
            $statement = $this->connection->prepare(
                "SELECT
                    e.id AS event_id,
                    e.name AS event_name,
                    e.status AS event_status,
                    e.bookingOpens AS event_bookingOpens,
                    e.bookingCloses AS event_bookingCloses,
                    e.recurringCycle AS event_recurringCycle,
                    e.recurringOrder AS event_recurringOrder,
                    e.recurringUntil AS event_recurringUntil,
                    e.maxCapacity AS event_maxCapacity,
                    e.price AS event_price,
                    e.description AS event_description,
                    e.color AS event_color,
                    e.show AS event_show,
                    e.notifyParticipants AS event_notifyParticipants,
                    e.locationId AS event_locationId,
                    e.customLocation AS event_customLocation,
                    e.parentId AS event_parentId,
                    e.created AS event_created,

                    c.id AS coupon_id,
                    c.code AS coupon_code,
                    c.discount AS coupon_discount,
                    c.deduction AS coupon_deduction,
                    c.limit AS coupon_limit,
                    c.customerLimit AS coupon_customerLimit,
                    c.status AS coupon_status
                FROM {$this->table} e
                LEFT JOIN {$couponToEventsTable} ce ON ce.eventId = e.id
                LEFT JOIN {$couponsTable} c ON c.id = ce.couponId
                {$where}"
            );

            $statement->execute($params);

            $rows = $statement->fetchAll();
        } catch (\Exception $e) {
            throw new QueryExecutionException('Unable to find by id in ' . __CLASS__, $e->getCode(), $e);
        }

        return call_user_func([static::FACTORY, 'createCollection'], $rows);
    }
}
