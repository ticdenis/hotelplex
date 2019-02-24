<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Event;

use DateTimeInterface;
use HotelPlex\Domain\ValueObject\DateTimeValueObject;
use HotelPlex\Domain\ValueObject\UuidValueObject;

abstract class DomainEvent
{
    /**
     * @var string
     */
    private $domainEventId;
    /**
     * @var DateTimeInterface
     */
    private $domainEventOccurredOn;

    public function __construct()
    {
        $this->domainEventId = (new UuidValueObject())->value();
        $this->domainEventOccurredOn = DateTimeValueObject::now()->value();
    }

    /**
     * @return string
     */
    public final function domainEventId(): string
    {
        return $this->domainEventId;
    }

    /**
     * @return string
     */
    public abstract function domainEventType(): string;

    /**
     * @return DateTimeInterface
     */
    public final function domainEventOccurredOn(): DateTimeInterface
    {
        return $this->domainEventOccurredOn;
    }
}
