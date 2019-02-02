<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Factory\Hotel;

use HotelPlex\Domain\Entity\Hotel\Hotel;

interface HotelFactory
{
    /**
     * @param array $source Constructor params.
     * @return Hotel
     */
    public function build(array $source): Hotel;
}
