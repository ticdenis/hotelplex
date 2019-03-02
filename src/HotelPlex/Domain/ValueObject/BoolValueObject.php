<?php

declare(strict_types=1);

namespace HotelPlex\Domain\ValueObject;

class BoolValueObject extends ValueObject
{
    /**
     * @param bool $value
     */
    public function __construct(bool $value)
    {
        parent::__construct($value);
    }

    /**
     * @return bool
     */
    public function value(): bool
    {
        return parent::value();
    }
}
