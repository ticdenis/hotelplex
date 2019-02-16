<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service;

use HotelPlex\Domain\Entity\User\ProviderEmail;
use HotelPlex\Domain\Entity\User\ProviderPassword;
use HotelPlex\Domain\ValueObject\UuidValueObject;
use Tasky\Domain\Model\User\ProviderInvalidEmailException;

final class ProviderRegisterRequest implements Request
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
     * ProviderRegisterRequest constructor.
     * @param string $uuid
     * @param string $username
     * @param string $email
     * @param string $password
     * @param array $hotels
     * @throws ProviderInvalidEmailException
     */
    public function __construct(
        string $uuid,
        string $username,
        string $email,
        string $password,
        array $hotels
    )
    {
        $this->uuid = new UuidValueObject($uuid);
        $this->username = $username;
        $this->email = new ProviderEmail($email);
        $this->password = new ProviderPassword($password);
        $this->hotels = $hotels;
    }

    /**
     * @return string
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
    public function email(): ProviderEmail
    {
        return $this->email;
    }

    /**
     * @return string
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

}
