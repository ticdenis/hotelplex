<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Entity\User;

use Exception;
use HotelPlex\Domain\ValueObject\ArrayValueObject;
use Webmozart\Assert\Assert;

final class UserHotels extends ArrayValueObject
{
    /**
     * @param array $hotels
     * @throws UserHotelsException
     */
    public function __construct(array $hotels)
    {
        if (!$hotels) {
            throw UserHotelsException::asEmpty();
        }

        try {
            Assert::allStringNotEmpty($hotels);
        } catch (Exception $e) {
            throw UserHotelsException::containsInvalidType();
        }

        parent::__construct($hotels);
    }
}
