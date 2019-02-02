<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Event;

use BadMethodCallException;
use function Lambdish\Phunctional\each;

final class DomainEventPublisher
{
    /**
     * @var null|DomainEventPublisher
     */
    private static $instance = null;
    /**
     * @var DomainEventListener[]
     */
    private $listeners;
    /**
     * @var int
     */
    private $id;

    /**
     * @return DomainEventPublisher
     */
    public static function instance(): self
    {
        if (static::$instance === null) {
            static::$instance = new self();
        }
        return static::$instance;
    }

    private function __construct()
    {
        $this->listeners = [];
        $this->id = 0;
    }

    public function __clone()
    {
        throw new BadMethodCallException('Clone is not supported');
    }

    /**
     * @param DomainEventListener $listener
     * @return int
     */
    public function subscribe(DomainEventListener $listener): int
    {
        $id = $this->id;
        $this->listeners[$id] = $listener;
        return ++$this->id;
    }

    /**
     * @param int $id
     * @return null|DomainEventListener
     */
    public function ofId(int $id): ?DomainEventListener
    {
        return isset($this->listeners[$id]) ? $this->listeners[$id] : null;
    }

    /**
     * @param int $id
     */
    public function unsubscribe(int $id): void
    {
        unset($this->listeners[$id]);
    }

    /**
     * @param DomainEvent $event
     * @return void
     */
    public function publish(DomainEvent $event): void
    {
        each(function (DomainEventListener $listener) use ($event) {
            if ($listener->isSubscribedTo($event)) {
                $listener->handle($event);
            }
        }, $this->listeners);
    }
}
