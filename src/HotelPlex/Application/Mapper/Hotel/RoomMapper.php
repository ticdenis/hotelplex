<?php

declare(strict_types=1);

namespace HotelPlex\Application\Mapper\Hotel;

use HotelPlex\Application\Mapper\Mapper;
use HotelPlex\Application\Mapper\MapperSanitizeTrait;
use HotelPlex\Domain\Entity\Hotel\Room\Room;

abstract class RoomMapper implements Mapper
{
    use MapperSanitizeTrait;

    /**
     * @return string
     */
    final public function entity(): string
    {
        return Room::class;
    }

    /**
     * @param $source
     * @return Room
     */
    abstract function item($source);

    /**
     * @param array $sources
     * @return Room[]
     */
    abstract function items(array $sources);
}
