<?php

declare(strict_types=1);

namespace Tasky\Domain\ValueObject;

abstract class IntValueObject extends ValueObject
{
    /**
     * @param int $value
     */
    public function __construct(int $value)
    {
        parent::__construct($value);
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return parent::value();
    }
}
