<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Exception\Hotel;

use HotelPlex\Domain\Exception\DomainException;

class HotelNotFoundException extends DomainException
{
    /**
     * @param string $uuid
     * @return HotelNotFoundException
     */
    public static function withUUID(string $uuid): self
    {
        return new self(sprintf(
            'Hotel not found with uuid {%s}.',
            $uuid
        ), self::NOT_FOUND_CODE);
    }
}
