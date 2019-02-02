<?php

declare(strict_types=1);

namespace HotelPlex\Domain\ValueObject;

class FloatValueObject extends ValueObject
{
    /**
     * @param float $value
     */
    public function __construct(float $value)
    {
        parent::__construct($value);
    }

    /**
     * @return float
     */
    public function value(): float
    {
        return parent::value();
    }
}
