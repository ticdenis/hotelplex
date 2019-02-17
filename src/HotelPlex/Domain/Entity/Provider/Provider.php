<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Entity\Provider;

use HotelPlex\Domain\Event\DomainEventPublisher;
use HotelPlex\Domain\Event\Provider\ProviderRegistered;
use HotelPlex\Domain\ValueObject\DateTimeValueObject;
use HotelPlex\Domain\ValueObject\UuidValueObject;

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
        DateTimeValueObject $createdAt = null,
        DateTimeValueObject $updatedAt = null
    )
    {
        $this->uuid = $uuid;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = $createdAt ?? DateTimeValueObject::now();
        $this->updatedAt = $updatedAt ?? DateTimeValueObject::now();
    }

    /**
     * @param UuidValueObject $uuid
     * @param string $username
     * @param ProviderEmail $email
     * @param ProviderPassword $password
     * @return Provider
     */
    public static function register(
        UuidValueObject $uuid,
        string $username,
        ProviderEmail $email,
        ProviderPassword $password
    ): self
    {
        $provider = new self($uuid, $username, $email, $password);

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
