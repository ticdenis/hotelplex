<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Entity\Provider;

use HotelPlex\Domain\ValueObject\StringValueObject;
use Tasky\Domain\Model\User\ProviderInvalidEmailException;
use Tasky\Domain\Model\User\UserInvalidEmailException;

final class ProviderEmail extends StringValueObject
{
    /**
     * @param string $value
     * @throws ProviderInvalidEmailException
     */
    public function __construct(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw ProviderInvalidEmailException::withEmail($value);
        }

        parent::__construct($value);
    }
}
