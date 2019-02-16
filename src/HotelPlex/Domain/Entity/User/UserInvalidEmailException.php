<?php

declare(strict_types=1);

namespace Tasky\Domain\Model\User;

use HotelPlex\Domain\Exception\DomainException;

class UserInvalidEmailException extends DomainException
{
    /**
     * @param string $email
     * @return UserInvalidEmailException
     */
    public static function withEmail(string $email): self
    {
        return new self(sprintf(
            'User email is invalid with "%s".',
            $email
        ));
    }
}
