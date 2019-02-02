<?php

declare(strict_types=1);

namespace HotelPlex\Domain\ValueObject;

abstract class ValueObject
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param mixed $value
     */
    public function __construct($value = null)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @param ValueObject $other
     * @return bool
     */
    public function equalsTo(ValueObject $other): bool
    {
        return $this->value() === $other->value();
    }
}
