<?php

declare(strict_types=1);

namespace HotelPlex\Tests\Infrastructure\Domain\Event;

use HotelPlex\Domain\Event\DomainEvent;
use HotelPlex\Domain\Event\DomainEventListener;

final class SpyDomainEventListener implements DomainEventListener
{
    /**
     * @var DomainEvent
     */
    private $domainEvent;

    /**
     * @param DomainEvent $event
     */
    public function handle(DomainEvent $event): void
    {
        $this->domainEvent = $event;
    }

    /**
     * @param DomainEvent $event
     * @return bool
     */
    public function isSubscribedTo(DomainEvent $event): bool
    {
        return true;
    }

    /**
     * @return DomainEvent
     */
    public function domainEvent(): DomainEvent
    {
        return $this->domainEvent;
    }
}


