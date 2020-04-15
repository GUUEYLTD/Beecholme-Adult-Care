<?php

namespace AmeliaBooking\Domain\Entity\Location;

use AmeliaBooking\Domain\ValueObjects\String\Status;
use AmeliaBooking\Domain\ValueObjects\Picture;
use AmeliaBooking\Domain\ValueObjects\String\Address;
use AmeliaBooking\Domain\ValueObjects\String\Description;
use AmeliaBooking\Domain\ValueObjects\GeoTag;
use AmeliaBooking\Domain\ValueObjects\Number\Integer\Id;
use AmeliaBooking\Domain\ValueObjects\String\Name;
use AmeliaBooking\Domain\ValueObjects\String\Phone;
use AmeliaBooking\Domain\ValueObjects\String\Url;

/**
 * Class Location
 *
 * @package AmeliaBooking\Domain\Entity\Location
 */
class Location
{
    /** @var Id */
    private $id;

    /** @var Status */
    private $status;

    /** @var Name */
    private $name;

    /** @var Description */
    private $description;

    /** @var Address */
    private $address;

    /** @var Phone */
    private $phone;

    /** @var GeoTag */
    private $coordinates;

    /** @var Picture */
    private $picture;

    /** @var Url */
    private $pin;

    /**
     * Location constructor.
     *
     * @param Name    $name
     * @param Address $address
     * @param Phone   $phone
     * @param GeoTag  $coordinates
     */
    public function __construct(
        Name $name,
        Address $address,
        Phone $phone,
        GeoTag $coordinates
    ) {
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
        $this->coordinates = $coordinates;
    }

    /**
     * @return Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Id $id
     */
    public function setId(Id $id)
    {
        $this->id = $id;
    }

    /**
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param Status $status
     */
    public function setStatus(Status $status)
    {
        $this->status = $status;
    }

    /**
     * @return Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param Name $name
     */
    public function setName(Name $name)
    {
        $this->name = $name;
    }

    /**
     * @return Description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param Description $description
     */
    public function setDescription(Description $description)
    {
        $this->description = $description;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
    }

    /**
     * @return Phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param Phone $phone
     */
    public function setPhone(Phone $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return GeoTag
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * @param GeoTag $coordinates
     */
    public function setCoordinates(GeoTag $coordinates)
    {
        $this->coordinates = $coordinates;
    }

    /**
     * @return Picture
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param Picture $picture
     */
    public function setPicture(Picture $picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return Url
     */
    public function getPin()
    {
        return $this->pin;
    }

    /**
     * @param Url $pin
     */
    public function setPin(Url $pin)
    {
        $this->pin = $pin;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id'               => null !== $this->getId() ? $this->getId()->getValue() : null,
            'status'           => $this->getStatus()->getValue(),
            'name'             => $this->getName()->getValue(),
            'description'      => null !== $this->getDescription() ? $this->getDescription()->getValue() : null,
            'address'          => $this->getAddress()->getValue(),
            'phone'            => $this->getPhone()->getValue(),
            'latitude'         => $this->getCoordinates()->getLatitude(),
            'longitude'        => $this->getCoordinates()->getLongitude(),
            'pictureFullPath'  => null !== $this->getPicture() ? $this->getPicture()->getFullPath() : null,
            'pictureThumbPath' => null !== $this->getPicture() ? $this->getPicture()->getThumbPath() : null,
            'pin'              => null !== $this->getPin() ? $this->getPin()->getValue() : null,
        ];
    }
}
