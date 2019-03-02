<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Event\User;

use HotelPlex\Domain\Entity\User\User;
use HotelPlex\Domain\Event\DomainEvent;

abstract class UserDomainEvent extends DomainEvent
{
    public function domainEventType(): string
    {
        return User::class;
    }
}
