<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Entity\Provider;

use DateTime;
use HotelPlex\Domain\Entity\User\ProviderEmail;
use HotelPlex\Domain\Entity\User\ProviderPassword;
use HotelPlex\Domain\Event\DomainEventPublisher;
use HotelPlex\Domain\ValueObject\DateTimeValueObject;
use HotelPlex\Domain\ValueObject\UuidValueObject;
use Tasky\Domain\Model\User\ProviderRegistered;

final class Provider
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
     * @var ProviderEmail
     */
    private $email;
    /**
     * @var ProviderPassword
     */
    private $password;
    /**
     * @var array
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

    public function __construct(
        UuidValueObject $uuid,
        string $username,
        ProviderEmail $email,
        ProviderPassword $password,
        array $hotels,
        DateTimeValueObject $createdAt = null,
        DateTimeValueObject $updatedAt = null
    )
    {

        $this->uuid = $uuid;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->hotels = $hotels;
        $this->createdAt = $createdAt ?? new DateTime();
        $this->updatedAt = $updatedAt ?? new DateTime();
    }

    public static function register(
        UuidValueObject $uuid,
        string $username,
        ProviderEmail $email,
        ProviderPassword $password,
        array $hotels
    ): self
    {
        $provider = new self($uuid, $username, $email, $password, $hotels);

        DomainEventPublisher::instance()->publish(
            new ProviderRegistered(
                $uuid->value(),
                $username,
                $email->value()
            )
        );

        return $provider;
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
     * @return ProviderEmail
     */
    public function email(): ProviderEmail
    {
        return $this->email;
    }

    /**
     * @return ProviderPassword
     */
    public function password(): ProviderPassword
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
