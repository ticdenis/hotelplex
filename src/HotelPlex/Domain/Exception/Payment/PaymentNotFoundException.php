<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Exception\Payment;

use HotelPlex\Domain\Exception\DomainException;

class PaymentNotFoundException extends DomainException
{
    /**
     * @param string $uuid
     * @return PaymentNotFoundException
     */
    public static function withUUID(string $uuid): self
    {
        return new self(sprintf(
            'Payment not fount with uuid "%s"',
            $uuid
        ), self::NOT_FOUND_CODE);
    }
}
