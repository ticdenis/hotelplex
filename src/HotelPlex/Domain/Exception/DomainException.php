<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Exception;

use Exception;

abstract class DomainException extends Exception
{
    const NOT_FOUND_CODE = 404;
}
