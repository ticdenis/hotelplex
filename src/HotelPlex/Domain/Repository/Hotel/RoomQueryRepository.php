<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Repository\Hotel;

use HotelPlex\Domain\Entity\Hotel\Room\Room;
use HotelPlex\Domain\Entity\Hotel\Room\RoomId;

interface RoomQueryRepository
{
    /**
     * @return Room[]
     */
    public function all(): array;

    /**
     * @param RoomId $id
     * @return Room
     */
    public function ofId(RoomId $id): ?Room;
}
