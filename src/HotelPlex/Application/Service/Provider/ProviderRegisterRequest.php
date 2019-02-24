<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service\Provider;

use HotelPlex\Application\Service\Request;
use HotelPlex\Domain\Entity\Provider\ProviderEmail;
use HotelPlex\Domain\Entity\Provider\ProviderId;
use HotelPlex\Domain\Entity\Provider\ProviderPassword;
use HotelPlex\Domain\Entity\Provider\ProviderUsername;
use Tasky\Domain\Model\Provider\ProviderInvalidEmailException;

final class ProviderRegisterRequest implements Request
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
        $this->uuid = new ProviderId($uuid);
        $this->username = new ProviderUsername($username);
        $this->email = new ProviderEmail($email);
        $this->password = new ProviderPassword($password);
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
