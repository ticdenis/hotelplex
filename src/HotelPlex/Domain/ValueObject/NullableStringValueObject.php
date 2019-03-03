<?php

declare(strict_types=1);

namespace HotelPlex\Domain\ValueObject;

class NullableStringValueObject extends ValueObject
{
    /**
     * @param string|null $value
     */
    public function __construct(string $value = null)
    {
        parent::__construct($value);
    }

    /**
     * @return string|null
     */
    public function value(): ?string
    {
        return parent::value();
    }
}
