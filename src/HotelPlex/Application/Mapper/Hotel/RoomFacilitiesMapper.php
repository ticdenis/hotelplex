<?php

declare(strict_types=1);

namespace HotelPlex\Application\Mapper\Hotel;

use HotelPlex\Application\Mapper\Mapper;
use HotelPlex\Application\Mapper\MapperSanitizeTrait;
use HotelPlex\Domain\Entity\Hotel\Room\RoomFacilities;

abstract class RoomFacilitiesMapper implements Mapper
{
    use MapperSanitizeTrait;

    /**
     * @return string
     */
    final public function entity(): string
    {
        return RoomFacilities::class;
    }

    /**
     * @param $source
     * @return RoomFacilities
     */
    abstract function item($source);

    /**
     * @param array $sources
     * @return RoomFacilities[]
     */
    abstract function items(array $sources);
}
