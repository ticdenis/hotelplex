<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Entity\User;

use HotelPlex\Domain\ValueObject\StringValueObject;
use Tasky\Domain\Model\User\UserInvalidEmailException;

final class UserEmail extends StringValueObject
{
    /**
     * @param string $value
     * @throws UserInvalidEmailException
     */
    public function __construct(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw UserInvalidEmailException::withEmail($value);
        }

        parent::__construct($value);
    }
}
