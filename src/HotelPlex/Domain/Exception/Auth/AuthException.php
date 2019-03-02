<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Exception\Auth;

use HotelPlex\Domain\Exception\DomainException;

final class AuthException extends DomainException
{
    /**
     * @param string $email
     * @return AuthException
     */
    public static function withEmail(string $email): self
    {
        return new self(sprintf(
            'Auth credentials invalid with email {%s}.',
            $email
        ), self::UNAUTHORIZED_CODE);
    }
}
