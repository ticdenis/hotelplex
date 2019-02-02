<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Event;

use DateTimeInterface;

interface DomainEvent
{
    /**
     * @return DateTimeInterface
     */
    public function occurredOn(): DateTimeInterface;
}
