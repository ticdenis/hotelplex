<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Repository\Hotel;

use HotelPlex\Domain\Entity\Hotel\Hotel;
use HotelPlex\Domain\Exception\Hotel\HotelNotFoundException;
use HotelPlex\Domain\ValueObject\UuidValueObject;

interface HotelQueryRepository
{
    /**
     * @return Hotel[]
     */
    public function all(): array;

    /**
     * @param UuidValueObject $uuid
     * @return Hotel
     * @throws HotelNotFoundException
     */
    public function ofIdOrFail(UuidValueObject $uuid): Hotel;
}
