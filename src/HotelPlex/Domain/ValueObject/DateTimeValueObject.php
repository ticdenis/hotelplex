<?php

declare(strict_types=1);

namespace HotelPlex\Domain\ValueObject;

use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;

class DateTimeValueObject extends ValueObject
{
    /**
     * @param DateTimeInterface $value
     */
    public function __construct(DateTimeInterface $value)
    {
        parent::__construct($value);
    }

    /** @noinspection PhpDocMissingThrowsInspection */
    /**
     * @param DateTimeZone|null $timezone
     * @return DateTimeValueObject
     */
    public static function now(DateTimeZone $timezone = null): DateTimeValueObject
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return new self(new DateTimeImmutable('now', $timezone));
    }

    /**
     * @return DateTimeInterface
     */
    public function value(): DateTimeInterface
    {
        return parent::value();
    }
}
