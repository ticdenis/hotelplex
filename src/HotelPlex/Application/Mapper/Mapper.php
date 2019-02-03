<?php

declare(strict_types=1);

namespace HotelPlex\Application\Mapper;

use stdClass;

interface Mapper
{
    /**
     * @return string
     */
    public function entity(): string;

    /**
     * @param stdClass $source
     * @return stdClass
     */
    public function item($source);

    /**
     * @param array $sources
     * @return array
     */
    public function items(array $sources);
}
