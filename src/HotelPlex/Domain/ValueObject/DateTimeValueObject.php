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
     * @param string $value
     * @param DateTimeZone|null $timezone
     * @return DateTimeValueObject
     */
    public static function fromString(string $value, $timezone = null): DateTimeValueObject
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return new self(new DateTimeImmutable($value, $timezone));
    }

    /** @noinspection PhpDocMissingThrowsInspection */
    /**
     * @param int $value
     * @param DateTimeZone|null $timezone
     * @return DateTimeValueObject
     */
    public static function fromInt(int $value, $timezone = null): DateTimeValueObject
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return new self((new DateTimeImmutable('now', $timezone))->setTimestamp($value));
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
