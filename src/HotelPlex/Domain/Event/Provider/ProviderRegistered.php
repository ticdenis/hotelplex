<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Event\Provider;

class ProviderRegistered extends ProviderDomainEvent
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
        parent::__construct();
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
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
}
