<?php

declare(strict_types=1);

namespace HotelPlex\Domain\ValueObject;

use Ramsey\Uuid\Uuid;

class UuidValueObject extends StringValueObject
{
    /** @noinspection PhpDocMissingThrowsInspection */
    /**
     * @param string|null $value
     */
    public function __construct(string $value = null)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        parent::__construct($value ?? Uuid::uuid4()->toString());
    }
}
