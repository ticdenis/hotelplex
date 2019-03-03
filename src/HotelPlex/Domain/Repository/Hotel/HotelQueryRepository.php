<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Repository\Hotel;

use HotelPlex\Domain\Entity\Hotel\Hotel;
use HotelPlex\Domain\ValueObject\UuidValueObject;

interface HotelQueryRepository
{
    /**
     * @return Hotel[]
     */
    public function all(): array;

    /**
     * @param UuidValueObject $id
     * @return Hotel
     */
    public function ofId(UuidValueObject $id): ?Hotel;
}
