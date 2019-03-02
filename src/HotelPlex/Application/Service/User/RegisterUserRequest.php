<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service\User;

use HotelPlex\Application\Service\Request;
use HotelPlex\Domain\Entity\User\UserEmail;
use HotelPlex\Domain\Entity\User\UserHotels;
use HotelPlex\Domain\Entity\User\UserHotelsException;
use HotelPlex\Domain\Entity\User\UserId;
use HotelPlex\Domain\Entity\User\UserPassword;
use HotelPlex\Domain\Entity\User\UserUsername;
use HotelPlex\Domain\Exception\User\UserInvalidEmailException;

final class RegisterUserRequest implements Request
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
     * @param string $uuid
     * @param string $username
     * @param string $email
     * @param string $password
     * @param array $hotels
     * @throws UserHotelsException
     * @throws UserInvalidEmailException
     */
    public function __construct(string $uuid, string $username, string $email, string $password, array $hotels)
    {
        $this->uuid = new UserId($uuid);
        $this->username = new UserUsername($username);
        $this->email = new UserEmail($email);
        $this->password = new UserPassword($password);
        $this->hotels = new UserHotels($hotels);
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
