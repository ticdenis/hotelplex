<?php

declare(strict_types=1);

namespace HotelPlex\Application\Mapper;

use HotelPlex\Application\Exception\Mapper\InvalidSourceArgumentToSanitizeException;
use function Lambdish\Phunctional\map;

trait MapperSanitizeTrait
{
    /**
     * @param mixed $source
     * @return object|object[]
     * @throws InvalidSourceArgumentToSanitizeException
     */
    protected function sanitize($source)
    {
        if (is_object($source)) {
            return $source;
        } else if ($isInvalid = !is_array($source) && empty($source)) {
            throw InvalidSourceArgumentToSanitizeException::withSource($source);
        } else if ($isSimpleArray = !isset($source[0]) || (!is_array($source[0]) && !is_object($source[0]))) {
            return (object) $source;
        }

        return map(function ($item) {
            return $this->sanitize($item);
        }, $source);
    }
}


