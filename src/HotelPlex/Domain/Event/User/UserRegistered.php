<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Event\User;

class UserRegistered extends UserDomainEvent
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
     * @var array
     */
    private $hotels;

    /**
     * @param string $id
     * @param string $username
     * @param string $email
     * @param array $hotels
     */
    public function __construct(
        string $id,
        string $username,
        string $email,
        array $hotels
    )
    {
        parent::__construct();
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->hotels = $hotels;
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
     * @return array
     */
    public function hotels(): array
    {
        return $this->hotels;
    }
}
