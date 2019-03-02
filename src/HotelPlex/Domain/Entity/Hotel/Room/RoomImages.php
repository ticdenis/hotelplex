<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Entity\Hotel\Room;

use Exception;
use HotelPlex\Domain\Exception\Hotel\RoomImagesException;
use HotelPlex\Domain\ValueObject\ArrayValueObject;
use Webmozart\Assert\Assert;

final class RoomImages extends ArrayValueObject
{
    /**
     * RoomImages constructor.
     * @param array $images
     * @throws RoomImagesException
     */
    public function __construct(array $images)
    {
        try {
            Assert::allStringNotEmpty($images);
        } catch (Exception $e) {
            throw RoomImagesException::containsInvalidType();
        }
        parent::__construct($images);
    }
}
