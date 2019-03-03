<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Event\Hotel;

use HotelPlex\Domain\Entity\Hotel\Room\Room;
use HotelPlex\Domain\Event\DomainEvent;

abstract class RoomDomainEvent extends DomainEvent
{
    public function domainEventType(): string
    {
        return Room::class;
    }
}
