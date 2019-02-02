<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Event\Hotel;

use DateTimeInterface;
use HotelPlex\Domain\Event\DomainEvent;
use HotelPlex\Domain\ValueObject\DateTimeValueObject;

class HotelRegistered implements DomainEvent
{
    /**
     * @var string
     */
    private $uuid;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $address;
    /**
     * @var string
     */
    private $phone;
    /**
     * @var string
     */
    private $email;
    /**
     * @var bool
     */
    private $lift;
    /**
     * @var bool
     */
    private $wifi;
    /**
     * @var bool
     */
    private $accessibility;
    /**
     * @var bool
     */
    private $parking;
    /**
     * @var bool
     */
    private $kitchen;
    /**
     * @var bool
     */
    private $pets;
    /**
     * @var DateTimeInterface
     */
    private $occurredOn;

    /**
     * @param string $uuid
     * @param string $name
     * @param string $address
     * @param string $phone
     * @param string $email
     * @param bool $lift
     * @param bool $wifi
     * @param bool $accessibility
     * @param bool $parking
     * @param bool $kitchen
     * @param bool $pets
     */
    public function __construct(
        string $uuid,
        string $name,
        string $address,
        string $phone,
        string $email,
        bool $lift,
        bool $wifi,
        bool $accessibility,
        bool $parking,
        bool $kitchen,
        bool $pets
    )
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
        $this->lift = $lift;
        $this->wifi = $wifi;
        $this->accessibility = $accessibility;
        $this->parking = $parking;
        $this->kitchen = $kitchen;
        $this->pets = $pets;
        $this->occurredOn = DateTimeValueObject::now()->value();
    }

    /**
     * @return string
     */
    public function uuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function address(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function phone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * @return bool
     */
    public function lift(): bool
    {
        return $this->lift;
    }

    /**
     * @return bool
     */
    public function wifi(): bool
    {
        return $this->wifi;
    }

    /**
     * @return bool
     */
    public function accessibility(): bool
    {
        return $this->accessibility;
    }

    /**
     * @return bool
     */
    public function parking(): bool
    {
        return $this->parking;
    }

    /**
     * @return bool
     */
    public function kitchen(): bool
    {
        return $this->kitchen;
    }

    /**
     * @return bool
     */
    public function pets(): bool
    {
        return $this->pets;
    }

    /**
     * @return DateTimeInterface
     */
    public function occurredOn(): DateTimeInterface
    {
        return $this->occurredOn;
    }
}
