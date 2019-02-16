<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service\Auth;

use HotelPlex\Application\Service\Request;

class TokenRequest implements Request
{
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function password(): string
    {
        return $this->password;
    }
}
