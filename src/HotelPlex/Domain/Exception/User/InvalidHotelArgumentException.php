<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Entity\User;

use HotelPlex\Domain\Exception\DomainException;

final class InvalidHotelArgumentException extends DomainException
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

    public static function containsInvalidType(): self
    {
        return new self(sprintf(
            'The array contains invalid type, expected string'
        ));
    }

}
