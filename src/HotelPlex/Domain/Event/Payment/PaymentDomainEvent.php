<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Event\Payment;

use HotelPlex\Domain\Entity\Payment\Payment;
use HotelPlex\Domain\Event\DomainEvent;

abstract class PaymentDomainEvent extends DomainEvent
{
    public function domainEventType(): string
    {
        return Payment::class;
    }
}
