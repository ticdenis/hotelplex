<?php

declare(strict_types=1);

namespace HotelPlex\Application\Mapper\Hotel;

use HotelPlex\Application\Mapper\Mapper;
use HotelPlex\Application\Mapper\MapperSanitizeTrait;
use HotelPlex\Domain\Entity\Hotel\Hotel;

abstract class HotelMapper implements Mapper
{
    use MapperSanitizeTrait;

    /**
     * @return string
     */
    final public function entity(): string
    {
        return Hotel::class;
    }

    /**
     * @param $source
     * @return Hotel
     */
    abstract function item($source);

    /**
     * @param array $sources
     * @return Hotel[]
     */
    abstract function items(array $sources);
}
