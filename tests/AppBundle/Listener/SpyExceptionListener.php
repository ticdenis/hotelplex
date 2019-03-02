<?php

declare(strict_types=1);

namespace App\Tests\Listener;

use App\Listener\ExceptionListener;
use HotelPlex\Domain\Exception\DomainException;

final class SpyExceptionListener
{
    /**
     * @param callable $fn
     * @return mixed
     */
    public static function execute(callable $fn)
    {
        try {
            return $fn();
        } catch (DomainException $exception) {
            return ExceptionListener::domainDefaultJsonResponse($exception);
        }
    }
}
