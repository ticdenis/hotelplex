<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service\Provider;

use HotelPlex\Application\Service\Request;
use HotelPlex\Domain\Entity\Provider\ProviderEmail;
use HotelPlex\Domain\Entity\Provider\ProviderPassword;
use HotelPlex\Domain\ValueObject\UuidValueObject;
use Tasky\Domain\Model\Provider\ProviderInvalidEmailException;

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
     * ProviderRegisterRequest constructor.
     * @param string $uuid
     * @param string $username
     * @param string $email
     * @param string $password
     * @throws ProviderInvalidEmailException
     */
    public function __construct(
        string $uuid,
        string $username,
        string $email,
        string $password
    )
    {
        $this->uuid = new UuidValueObject($uuid);
        $this->username = $username;
        $this->email = new ProviderEmail($email);
        $this->password = new ProviderPassword($password);
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

}
