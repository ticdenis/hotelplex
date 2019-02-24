<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Entity\Provider;

use HotelPlex\Domain\Event\DomainEventPublisher;
use HotelPlex\Domain\Event\Provider\ProviderRegistered;

final class Provider
{
    /**
     * @var ProviderId
     */
    private $uuid;
    /**
     * @var ProviderUsername
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
     * @param ProviderId $uuid
     * @param ProviderUsername $username
     * @param ProviderEmail $email
     * @param ProviderPassword $password
     */
    public function __construct(
        ProviderId $uuid,
        ProviderUsername $username,
        ProviderEmail $email,
        ProviderPassword $password
    )
    {
        $this->uuid = $uuid;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @param ProviderId $uuid
     * @param ProviderUsername $username
     * @param ProviderEmail $email
     * @param ProviderPassword $password
     * @return Provider
     */
    public static function register(
        ProviderId $uuid,
        ProviderUsername $username,
        ProviderEmail $email,
        ProviderPassword $password
    ): self
    {
        $provider = new self($uuid, $username, $email, $password);

        DomainEventPublisher::instance()->publish(
            new ProviderRegistered(
                $uuid->value(),
                $username->value(),
                $email->value()
            )
        );

        return $provider;
    }

    /**
     * @return ProviderId
     */
    public function uuid(): ProviderId
    {
        return $this->uuid;
    }

    /**
     * @return ProviderUsername
     */
    public function username(): ProviderUsername
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
}
