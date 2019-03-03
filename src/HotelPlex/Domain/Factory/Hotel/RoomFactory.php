<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Factory\Hotel;

use HotelPlex\Domain\Entity\Hotel\Room\Room;

interface RoomFactory
{
    /**
     * @param array $source Constructor params.
     * @return Room
     */
    public function build(array $source): Room;
}
