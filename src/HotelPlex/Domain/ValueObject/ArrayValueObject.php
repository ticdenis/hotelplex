<?php

declare(strict_types=1);

namespace HotelPlex\Domain\ValueObject;

abstract class ArrayValueObject extends ValueObject
{
    /**
     * @param array $value
     */
    public function __construct(array $value)
    {
        parent::__construct($value);
    }

    /**
     * @return array
     */
    public function value(): array
    {
        return parent::value();
    }
}
