<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Exception\Hotel;

use HotelPlex\Domain\Exception\DomainException;

final class RoomBedException extends DomainException
{

    /**
     * @param array $keys
     * @return RoomBedException
     */
    public static function invalidBedKeysWith(array $keys): self
    {
        return new self(sprintf(
            'Invalid bed keys with {%s}. Must be integers.',
            join(',', $keys)
        ), self::NOT_FOUND_CODE);
    }

    /**
     * @param array $values
     * @return RoomBedException
     */
    public static function invalidBedValuesWith(array $values): self
    {
        return new self(sprintf(
            'Invalid bed values with {%s}. Must be booleans.',
            join(',', $values)
        ), self::NOT_FOUND_CODE);
    }
}
