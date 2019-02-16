<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Exception;

use Exception;

abstract class DomainException extends Exception
{
    const UNAUTHORIZED_CODE = 401;
    const NOT_FOUND_CODE = 404;
    const SERVER_ERROR_CODE = 500;
}
