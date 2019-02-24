<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Event\Provider;

use HotelPlex\Domain\Entity\Provider\Provider;
use HotelPlex\Domain\Event\DomainEvent;

abstract class ProviderDomainEvent extends DomainEvent
{
    public function domainEventType(): string
    {
        return Provider::class;
    }
}
