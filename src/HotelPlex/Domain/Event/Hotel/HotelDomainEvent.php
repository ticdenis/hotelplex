<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Event\Hotel;

use HotelPlex\Domain\Entity\Hotel\Hotel;
use HotelPlex\Domain\Event\DomainEvent;

abstract class HotelDomainEvent extends DomainEvent
{
    public function domainEventType(): string
    {
        return Hotel::class;
    }
}
