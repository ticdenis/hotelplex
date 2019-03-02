<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Entity\Hotel\Room;

use HotelPlex\Domain\Exception\Hotel\RoomBedException;
use HotelPlex\Domain\ValueObject\ArrayValueObject;
use HotelPlex\Domain\ValueObject\ValueObject;
use Webmozart\Assert\Assert;

abstract class RoomBeds extends ArrayValueObject
{
    /**
     * @param array $beds
     * @throws RoomBedException
     */
    public function __construct(array $beds)
    {
        $keys = array_keys($beds);
        $values = array_values($beds);

        try {
            Assert::allInteger($keys);
        } catch (\Exception $e) {
            throw RoomBedException::invalidBedKeysWith($keys);
        }

        try {
            Assert::allBoolean($values);
        } catch (\Exception $e) {
            throw RoomBedException::invalidBedValuesWith($values);
        }

        parent::__construct($beds);
    }

    /**
     * @param RoomBeds $other
     * @return bool
     */
    public function equalsTo(ValueObject $other): bool
    {
        return count(array_diff($this->value, $other->value)) === 0;
    }
}
