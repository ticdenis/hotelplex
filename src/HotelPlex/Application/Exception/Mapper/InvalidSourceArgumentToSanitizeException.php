<?php

declare(strict_types=1);

namespace HotelPlex\Application\Exception\Mapper;

use HotelPlex\Application\Exception\ApplicationException;

class InvalidSourceArgumentToSanitizeException extends ApplicationException
{
    /**
     * @param mixed $source
     * @return InvalidSourceArgumentToSanitizeException
     */
    public static function withSource($source): self
    {
        return new self(sprintf(
         "Invalid source argument while sanitizing \n %s",
            print_r($source, true)
        ));
    }
}
