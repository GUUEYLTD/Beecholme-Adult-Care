<?php

namespace AmeliaBooking\Infrastructure\Repository\User;

use AmeliaBooking\Domain\Collection\Collection;
use AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException;
use AmeliaBooking\Domain\Entity\User\AbstractUser;
use AmeliaBooking\Domain\Entity\User\Admin;
use AmeliaBooking\Domain\Entity\User\Customer;
use AmeliaBooking\Domain\Entity\User\Manager;
use AmeliaBooking\Domain\Entity\User\Provider;
use AmeliaBooking\Domain\Factory\User\UserFactory;
use AmeliaBooking\Domain\Repository\User\UserRepositoryInterface;
use AmeliaBooking\Domain\ValueObjects\Json;
use AmeliaBooking\Domain\ValueObjects\String\Password;
use AmeliaBooking\Domain\ValueObjects\String\Status;
use AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException;
use AmeliaBooking\Infrastructure\Repository\AbstractRepository;
use AmeliaBooking\Infrastructure\WP\InstallActions\DB\Booking\CustomerBookingsTable;

/**
 * Class UserRepository
 *
 * @package AmeliaBooking\Infrastructure\Repository
 */
class UserRepository extends AbstractRepository implements UserRepositoryInterface
{

    const FACTORY = UserFactory::class;

    /**
     * @param AbstractUser $entity
     *
     * @return int
     * @throws QueryExecutionException
     */
    public function add($entity)
    {
        $data = $entity->toArray();

        $params = [
            ':type'             => $data['type'],
            ':status'           => $data['status'] ?: 'visible',
            ':externalId'       => $data['externalId'] ?: null,
            ':firstName'        => $data['firstName'],
            ':lastName'         => $data['lastName'],
            ':email'            => $data['email'],
            ':note'             => isset($data['note']) ? $data['note'] : null,
            ':phone'            => isset($data['phone']) ? $data['phone'] : null,
            ':gender'           => isset($data['gender']) ? $data['gender'] : null,
            ':birthday'         => $data['birthday'] ? $data['birthday']->format('Y-m-d') : null,
            ':pictureFullPath'  => $data['pictureFullPath'],
            ':pictureThumbPath' => $data['pictureThumbPath'],
            ':password'         => isset($data['password']) ? $data['password'] : null,
            ':usedTokens'       => isset($data['usedTokens']) ? $data['usedTokens'] : null,
            ':zoomUserId'       => isset($data['zoomUserId']) ? $data['zoomUserId'] : null,
        ];

        try {
            $statement = $this->connection->prepare(
                "INSERT INTO {$this->table} (
                `type`,
                `status`,
                `externalId`,
                `firstName`,
                `lastName`,
                `email`,
                `note`,
                `phone`,
                `gender`,
                `birthday`,
                `pictureFullPath`,
                `pictureThumbPath`,
                `zoomUserId`,
                `usedTokens`,
                `password`
                ) VALUES (
                :type,
                :status,
                :externalId,
                :firstName,
                :lastName,
                :email,
                :note,
                :phone,
                :gender,
                STR_TO_DATE(:birthday, '%Y-%m-%d'),
                :pictureFullPath,
                :pictureThumbPath,
                :zoomUserId,
                :usedTokens,
                :password
                )"
            );

            $res = $statement->execute($params);

            if (!$res) {
                throw new QueryExecutionException('Unable to add data in ' . __CLASS__);
            }
        } catch (\Exception $e) {
            throw new QueryExecutionException('Unable to add data in ' . __CLASS__, $e->getCode(), $e);
        }

        return $this->connection->lastInsertId();
    }

    /**
     * @param int          $id
     * @param AbstractUser $entity
     *
     * @return bool
     * @throws QueryExecutionException
     */
    public function update($id, $entity)
    {
        $data = $entity->toArray();

        $params = [
            ':externalId'       => $data['externalId'] ?: null,
            ':firstName'        => $data['firstName'],
            ':lastName'         => $data['lastName'],
            ':email'            => $data['email'],
            ':note'             => isset($data['note']) ? $data['note'] : null,
            ':phone'            => isset($data['phone']) ? $data['phone'] : null,
            ':gender'           => isset($data['gender']) ? $data['gender'] : null,
            ':birthday'         => isset($data['birthday']) ? $data['birthday']->format('Y-m-d') : null,
            ':pictureFullPath'  => $data['pictureFullPath'],
            ':pictureThumbPath' => $data['pictureThumbPath'],
            ':zoomUserId'       => isset($data['zoomUserId']) ? $data['zoomUserId'] : null,
            ':id'               => $id,
        ];

        try {
            $statement = $this->connection->prepare(
                "UPDATE {$this->table}
                SET
                `externalId` = :externalId,
                `firstName` = :firstName,
                `lastName` = :lastName,
                `email` = :email,
                `note` = :note,
                `phone` = :phone,
                `gender` = :gender,
                `birthday` = STR_TO_DATE(:birthday, '%Y-%m-%d'),
                `zoomUserId` = :zoomUserId,
                `pictureFullPath` = :pictureFullPath,
                `pictureThumbPath` = :pictureThumbPath
                WHERE 
                id = :id"
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
     * @param $externalId
     *
     * @return Admin|Customer|Manager|Provider|bool
     * @throws InvalidArgumentException
     * @throws QueryExecutionException
     */
    public function findByExternalId($externalId)
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE externalId = :id");
            $statement->bindParam(':id', $externalId);
            $statement->execute();
            $row = $statement->fetch();
        } catch (\Exception $e) {
            throw new QueryExecutionException('Unable to find by external id in ' . __CLASS__, $e->getCode(), $e);
        }

        if (!$row) {
            return false;
        }

        return UserFactory::create($row);
    }

    /**
     * @param $type
     *
     * @return Collection
     * @throws QueryExecutionException
     * @throws InvalidArgumentException
     */
    public function getAllByType($type)
    {
        $params = [
            ':type' => $type,
        ];

        try {
            $statement = $this->connection->prepare($this->selectQuery() . ' WHERE type = :type');

            $statement->execute($params);

            $rows = $statement->fetchAll();
        } catch (\Exception $e) {
            throw new QueryExecutionException('Unable to get data from ' . __CLASS__, $e->getCode(), $e);
        }

        $items = [];
        foreach ($rows as $row) {
            $items[] = call_user_func([static::FACTORY, 'create'], $row);
        }

        return new Collection($items);
    }

    /**
     * Returns Collection of all customers and other users that have at least one booking
     *
     * @return Collection
     * @throws QueryExecutionException
     * @throws InvalidArgumentException
     */
    public function getAllWithAllowedBooking()
    {
        try {
            $bookingsTable = CustomerBookingsTable::getTableName();

            $statement = $this->connection->query("
            SELECT
            u.id AS id,
            u.firstName AS firstName,
            u.lastName AS lastName,
            u.email AS email,
            u.note AS note,
            u.phone AS phone,
            u.gender AS gender,
            u.status AS status
            FROM {$this->table} u
            LEFT JOIN {$bookingsTable} cb ON cb.customerId = u.id
            WHERE u.type = 'customer' OR (cb.id IS NOT NULL AND u.type IN ('admin', 'provider', 'manager'))
            GROUP BY u.id
            ORDER BY CONCAT(firstName, ' ', lastName) 
            ");

            $rows = $statement->fetchAll();
        } catch (\Exception $e) {
            throw new QueryExecutionException('Unable to get data from ' . __CLASS__, $e->getCode(), $e);
        }

        $items = [];
        foreach ($rows as $row) {
            $items[$row['id']] = call_user_func([static::FACTORY, 'create'], $row);
        }

        return new Collection($items);
    }

    /**
     * Returns Collection of all customers and other users that have at least one booking
     *
     * @return Collection
     * @throws QueryExecutionException
     * @throws InvalidArgumentException
     */
    public function getAllWithoutBookings()
    {
        $bookingsTable = CustomerBookingsTable::getTableName();

        try {
            $statement = $this->connection->query("
                SELECT
                    u.id AS id,
                    u.firstName AS firstName,
                    u.lastName AS lastName,
                    u.email AS email,
                    u.note AS note,
                    u.phone AS phone,
                    u.gender AS gender,
                    u.status AS status
                FROM {$this->table} u
                LEFT JOIN {$bookingsTable} cb ON cb.customerId = u.id
                WHERE
                (u.type = 'customer' OR (cb.id IS NOT NULL AND u.type IN ('admin', 'provider', 'manager')))
                AND cb.appointmentId IS NULL
                AND u.id NOT IN (
                    SELECT u2.id
                    FROM {$this->table} u2
                    INNER JOIN {$bookingsTable} cb2 ON cb2.customerId = u2.id
                    WHERE cb2.appointmentId IS NOT NULL
                )
                GROUP BY u.id
                ORDER BY CONCAT(firstName, ' ', lastName)
            ");

            $rows = $statement->fetchAll();
        } catch (\Exception $e) {
            throw new QueryExecutionException('Unable to get data from ' . __CLASS__, $e->getCode(), $e);
        }

        $items = [];
        foreach ($rows as $row) {
            $items[$row['id']] = call_user_func([static::FACTORY, 'create'], $row);
        }

        return new Collection($items);
    }

    /**
     * @param string  $email
     * @param boolean $setPassword
     * @param boolean $setUsedTokens
     *
     * @return Admin|Customer|Manager|Provider
     * @throws InvalidArgumentException
     * @throws QueryExecutionException
     */
    public function getByEmail($email, $setPassword = false, $setUsedTokens = false)
    {
        try {
            $statement = $this->connection->prepare($this->selectQuery() . ' WHERE LOWER(email) = LOWER(:email)');

            $statement->execute(array(
                ':email' => $email
            ));

            $row = $statement->fetch();
        } catch (\Exception $e) {
            throw new QueryExecutionException('Unable to get data from ' . __CLASS__, $e->getCode(), $e);
        }

        if (!$row) {
            return null;
        }

        /** @var Admin|Customer|Manager|Provider $user */
        $user = UserFactory::create($row);

        if ($setPassword) {
            $user->setPassword(Password::createFromHashedPassword($row['password']));
        }

        if ($setUsedTokens) {
            $user->setUsedTokens(new Json($row['usedTokens']));
        }

        return $user;
    }
}
