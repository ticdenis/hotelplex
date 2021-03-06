<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Entity\User;

use HotelPlex\Domain\Event\DomainEventPublisher;
use HotelPlex\Domain\Event\User\UserRegistered;

final class User
{
    /**
     * @var UserId
     */
    private $uuid;
    /**
     * @var UserUsername
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
     * @var UserHotels
     */
    private $hotels;

    /**
     * @param UserId $uuid
     * @param UserUsername $username
     * @param UserEmail $email
     * @param UserPassword $password
     * @param UserHotels $hotels
     */
    public function __construct(
        UserId $uuid,
        UserUsername $username,
        UserEmail $email,
        UserPassword $password,
        UserHotels $hotels
    )
    {
        $this->uuid = $uuid;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->hotels = $hotels;
    }

    /**
     * @param UserId $uuid
     * @param UserUsername $username
     * @param UserEmail $email
     * @param UserPassword $password
     * @param UserHotels $hotels
     * @return User
     */
    public static function register(
        UserId $uuid,
        UserUsername $username,
        UserEmail $email,
        UserPassword $password,
        UserHotels $hotels
    ): self
    {
        $user = new self($uuid, $username, $email, $password, $hotels);

        DomainEventPublisher::instance()->publish(
            new UserRegistered(
                $uuid->value(),
                $username->value(),
                $email->value(),
                $hotels->value()
            )
        );

        return $user;
    }

    /**
     * @return UserId
     */
    public function uuid(): UserId
    {
        return $this->uuid;
    }

    /**
     * @return UserUsername
     */
    public function username(): UserUsername
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
     * @return UserHotels
     */
    public function hotels(): UserHotels
    {
        return $this->hotels;
    }
}
