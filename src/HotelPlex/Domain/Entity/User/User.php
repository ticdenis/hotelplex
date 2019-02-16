<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Entity\User;

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
     * @var UserEmail
     */
    private $email;

    /**
     * @var UserPassword
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
        $this->createdAt = $createdAt ?? DateTimeValueObject::now();
        $this->updatedAt = $updatedAt ?? DateTimeValueObject::now();
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
     * @return UserEmail
     */
    public function email(): UserEmail
    {
        return $this->email;
    }

    /**
     * @return UserPassword
     */
    public function password(): UserPassword
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
