<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Entity\Hotel;

use HotelPlex\Domain\Event\DomainEventPublisher;
use HotelPlex\Domain\Event\Hotel\HotelRegistered;
use HotelPlex\Domain\Event\Hotel\HotelUpdatedInfo;
use HotelPlex\Domain\ValueObject\DateTimeValueObject;
use HotelPlex\Domain\ValueObject\UuidValueObject;

class Hotel
{
    /**
     * @var UuidValueObject
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
     * @var array
     */
    private $paymentMethods;
    /**
     * @var ?string
     */
    private $logo;
    /**
     * @var array
     */
    private $images;
    /**
     * @var DateTimeValueObject
     */
    private $createdAt;
    /**
     * @var DateTimeValueObject
     */
    private $updatedAt;

    /**
     * @param UuidValueObject $uuid
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
     * @param array $paymentMethods
     * @param string $logo
     * @param array $images
     * @param DateTimeValueObject $createdAt
     * @param DateTimeValueObject $updatedAt
     */
    public function __construct(
        UuidValueObject $uuid,
        string $name,
        string $address,
        string $phone,
        string $email,
        bool $lift,
        bool $wifi,
        bool $accessibility,
        bool $parking,
        bool $kitchen,
        bool $pets,
        array $paymentMethods,
        ?string $logo,
        array $images,
        DateTimeValueObject $createdAt,
        DateTimeValueObject $updatedAt
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
        $this->paymentMethods = $paymentMethods;
        $this->logo = $logo;
        $this->images = $images;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
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
     * @return Hotel
     */
    public static function register(
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
    ): Hotel
    {
        $hotel = new self(
            new UuidValueObject(),
            $name,
            $address,
            $phone,
            $email,
            $lift,
            $wifi,
            $accessibility,
            $parking,
            $kitchen,
            $pets,
            [],
            null,
            [],
            DateTimeValueObject::now(),
            DateTimeValueObject::now()
        );

        DomainEventPublisher::instance()->publish(
            new HotelRegistered(
                $hotel->uuid()->value(),
                $hotel->name(),
                $hotel->address(),
                $hotel->phone(),
                $hotel->email(),
                $hotel->lift(),
                $hotel->wifi(),
                $hotel->accessibility(),
                $hotel->parking(),
                $hotel->kitchen(),
                $hotel->pets()
            )
        );

        return $hotel;
    }

    /**
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
     * @param array $paymentMethods
     * @param string|null $logo
     * @param array $images
     */
    public function updateInfo(
        string $name,
        string $address,
        string $phone,
        string $email,
        bool $lift,
        bool $wifi,
        bool $accessibility,
        bool $parking,
        bool $kitchen,
        bool $pets,
        array $paymentMethods,
        ?string $logo,
        array $images
    )
    {
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
        $this->paymentMethods = $paymentMethods;
        $this->logo = $logo;
        $this->images = $images;
        $this->updatedAt = DateTimeValueObject::now();

        DomainEventPublisher::instance()->publish(
            new HotelUpdatedInfo(
                $this->uuid()->value(),
                $this->name(),
                $this->address(),
                $this->phone(),
                $this->email(),
                $this->lift(),
                $this->wifi(),
                $this->accessibility(),
                $this->parking(),
                $this->kitchen(),
                $this->pets(),
                $this->paymentMethods(),
                $this->logo(),
                $this->images()
            )
        );
    }

    /**
     * @return UuidValueObject
     */
    public function uuid(): UuidValueObject
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
     * @return array
     */
    public function paymentMethods(): array
    {
        return $this->paymentMethods;
    }

    /**
     * @return ?string
     */
    public function logo(): ?string
    {
        return $this->logo;
    }

    /**
     * @return array
     */
    public function images(): array
    {
        return $this->images;
    }

    /**
     * @return DateTimeValueObject
     */
    public function createdAt(): DateTimeValueObject
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeValueObject
     */
    public function updatedAt(): DateTimeValueObject
    {
        return $this->updatedAt;
    }
}
