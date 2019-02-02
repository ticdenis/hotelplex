<?php

declare(strict_types=1);

namespace HotelPlex\Domain\ValueObject;

class StringValueObject extends ValueObject
{
    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        parent::__construct($value);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return parent::value();
    }
}
