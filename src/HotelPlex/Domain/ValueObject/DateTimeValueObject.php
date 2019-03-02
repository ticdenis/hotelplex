<?php

declare(strict_types=1);

namespace HotelPlex\Domain\ValueObject;

use DateTime;
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
     * @return self
     */
    public static function fromString(string $value, $timezone = null): self
    {
        /**
         * @var DateTimeValueObject $class
         */
        $class = get_called_class();
        /** @noinspection PhpUnhandledExceptionInspection */
        return new $class(new DateTimeImmutable($value, $timezone));
    }

    /** @noinspection PhpDocMissingThrowsInspection */
    /**
     * @param int $value
     * @param DateTimeZone|null $timezone
     * @return self
     */
    public static function fromInt(int $value, $timezone = null): self
    {
        /**
         * @var DateTimeValueObject $class
         */
        $class = get_called_class();
        /** @noinspection PhpUnhandledExceptionInspection */
        return new $class((new DateTimeImmutable('now', $timezone))->setTimestamp($value));
    }

    /** @noinspection PhpDocMissingThrowsInspection */
    /**
     * @param DateTimeZone|null $timezone
     * @return self
     */
    public static function now(DateTimeZone $timezone = null): self
    {
        /**
         * @var DateTimeValueObject $class
         */
        $class = get_called_class();
        /** @noinspection PhpUnhandledExceptionInspection */
        return new $class(new DateTimeImmutable('now', $timezone));
    }

    /** @noinspection PhpDocMissingThrowsInspection */
    /**
     * @param DateTimeZone|null $timezone
     * @param string|int $value
     * @param string $type
     * @return DateTimeValueObject
     */
    public static function nowModify($value, string $type, DateTimeZone $timezone = null): self
    {
        /**
         * @var DateTimeValueObject $class
         */
        $class = get_called_class();

        $datetime = $class::now($timezone)->value();
        /** @noinspection PhpUnhandledExceptionInspection */
        $datetime = new DateTime($datetime->format('Y-m-d H:i:s'), $datetime->getTimezone());

        $datetime->modify($value . ' ' . $type);

        return $class::fromInt($datetime->getTimestamp(), $datetime->getTimezone());
    }

    /**
     * @return DateTimeInterface
     */
    public function value(): DateTimeInterface
    {
        return parent::value();
    }
}
