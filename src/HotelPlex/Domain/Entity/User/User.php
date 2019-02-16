<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Entity\User;

use DateTime;
use HotelPlex\Domain\ValueObject\DateTimeValueObject;
use HotelPlex\Domain\ValueObject\UuidValueObject;
use Webmozart\Assert\Assert;

final class User
{
    /**
     * @var UuidValueObject
     */
    private $uuid;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string[]
     */
    private $hotels;

    /**
     * @var DateTimeValueObject
     */
    private $createdAt;

    /**
     * @var DateTimeValueObject
     */
    private $updatedAt;

    /**
     * User constructor.
     * @param UuidValueObject $uuid
     * @param string $username
     * @param UserEmail $email
     * @param UserPassword $password
     * @param array $hotels
     * @param DateTimeValueObject $createdAt
     * @param DateTimeValueObject $updatedAt
     * @throws InvalidHotelArgumentException
     */
    public function __construct(
        UuidValueObject $uuid,
        string $username,
        UserEmail $email,
        UserPassword $password,
        array $hotels,
        DateTimeValueObject $createdAt = null,
        DateTimeValueObject $updatedAt = null
    )
    {
        $this->uuid = $uuid;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->setHotels($hotels);
        $this->createdAt = $createdAt ?? new DateTime();
        $this->updatedAt = $updatedAt ?? new DateTime();
    }

    /**
     * @param array $hotels
     * @throws InvalidHotelArgumentException
     * @throws \Exception
     */
    private function setHotels(array $hotels): void
    {
        if (!$hotels) {
            throw InvalidHotelArgumentException::asEmpty();
        }

        try {
            Assert::allStringNotEmpty($hotels);
        } catch (\Exception $e) {
            throw InvalidHotelArgumentException::containsInvalidType();
        }

        $this->hotels = $hotels;
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
    public function username(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function password(): string
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public function hotels(): array
    {
        return $this->hotels;
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
