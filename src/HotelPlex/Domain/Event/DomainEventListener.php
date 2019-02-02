<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Event;

interface DomainEventListener
{
    /**
     * @param DomainEvent $domainEvent
     */
    public function handle(DomainEvent $domainEvent): void;

    /**
     * @param DomainEvent $domainEvent
     * @return bool
     */
    public function isSubscribedTo(DomainEvent $domainEvent): bool;
}
