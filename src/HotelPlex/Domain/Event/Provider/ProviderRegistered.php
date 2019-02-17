<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Event\Provider;

use DateTime;
use DateTimeInterface;
use HotelPlex\Domain\Event\DomainEvent;

class ProviderRegistered implements DomainEvent
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var DateTime
     */
    private $occurredOn;

    /**
     * @param string $id
     * @param string $username
     * @param string $email
     */
    public function __construct(
        string $id,
        string $username,
        string $email
    )
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->occurredOn = new DateTime();
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
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
     * @return
     */
    public function occurredOn(): DateTimeInterface
    {
        return $this->occurredOn;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
