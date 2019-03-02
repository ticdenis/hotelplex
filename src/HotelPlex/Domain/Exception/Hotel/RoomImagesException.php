<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Exception\Hotel;

use HotelPlex\Domain\Exception\DomainException;

final class RoomImagesException extends DomainException
{
    /**
     * @return RoomImagesException
     */
    public static function containsInvalidType(): self
    {
        return new self(sprintf(
            'The array contains invalid type, expected string.'
        ));
    }

}
