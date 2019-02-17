<?php

declare(strict_types=1);

namespace HotelPlex\Application\Mapper\Provider;

use HotelPlex\Application\Mapper\Mapper;
use HotelPlex\Application\Mapper\MapperSanitizeTrait;
use HotelPlex\Domain\Entity\Provider\Provider;

abstract class ProviderMapper implements Mapper
{
    use MapperSanitizeTrait;

    /**
     * @return string
     */
    final public function entity(): string
    {
        return Provider::class;
    }

    /**
     * @param $source
     * @return Provider
     */
    abstract function item($source);

    /**
     * @param array $sources
     * @return Provider[]
     */
    abstract function items(array $sources);
}
