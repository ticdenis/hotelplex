<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Entity\User;

use HotelPlex\Domain\ValueObject\StringValueObject;

final class ProviderPassword extends StringValueObject
{
    /**
     * @param string $value
     * @param bool $encrypt
     */
    public function __construct(string $value, bool $encrypt = true)
    {
        parent::__construct($encrypt ? password_hash($value, PASSWORD_DEFAULT) : $value);
    }

    /**
     * @param string $password
     * @return bool
     */
    public function verify(string $password): bool
    {
        return password_verify($password, $this->value());
    }

}
