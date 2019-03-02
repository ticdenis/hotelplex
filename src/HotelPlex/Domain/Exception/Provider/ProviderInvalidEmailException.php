<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Exception\Provider;

use HotelPlex\Domain\Exception\DomainException;

class ProviderInvalidEmailException extends DomainException
{
    /**
     * @param string $email
     * @return ProviderInvalidEmailException
     */
    public static function withEmail(string $email): self
    {
        return new self(sprintf(
            'Provider email is invalid with {%s}.',
            $email
        ));
    }
}
