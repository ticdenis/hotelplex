<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Entity\User;

use HotelPlex\Domain\Exception\DomainException;

final class UserHotelsException extends DomainException
{

    /**
     * InvalidHotelArgumentException constructor.
     */
    public static function asEmpty(): self
    {
        return new self(sprintf(
            'User has not empty hotels list.'
        ));
    }

    /**
     * @return UserHotelsException
     */
    public static function containsInvalidType(): self
    {
        return new self(sprintf(
            'The array contains invalid type, expected string'
        ));
    }

}
