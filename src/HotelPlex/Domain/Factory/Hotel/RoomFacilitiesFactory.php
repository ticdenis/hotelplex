<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Factory\Hotel;

use HotelPlex\Domain\Entity\Hotel\Room\RoomFacilities;

interface RoomFacilitiesFactory
{
    /**
     * @param array $source Constructor params.
     * @return RoomFacilities
     */
    public function build(array $source): RoomFacilities;
}
