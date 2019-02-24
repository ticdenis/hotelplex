<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Event\Payment;

use DateTimeInterface;

final class PaymentCreated extends PaymentDomainEvent
{
    /**
     * @var string
     */
    private $uuid;
    /**
     * @var string
     */
    private $paymentMethod;
    /**
     * @var string
     */
    private $currency;
    /**
     * @var float
     */
    private $price;
    /**
     * @var DateTimeInterface
     */
    private $createdAt;

    /**
     * @param string $uuid
     * @param string $paymentMethod
     * @param string $currency
     * @param float $price
     * @param DateTimeInterface $createdAt
     */
    public function __construct(
        string $uuid,
        string $paymentMethod,
        string $currency,
        float $price,
        DateTimeInterface $createdAt
    )
    {
        $this->uuid = $uuid;
        $this->paymentMethod = $paymentMethod;
        $this->currency = $currency;
        $this->price = $price;
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function uuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function paymentMethod(): string
    {
        return $this->paymentMethod;
    }

    /**
     * @return string
     */
    public function currency(): string
    {
        return $this->currency;
    }

    /**
     * @return float
     */
    public function price(): float
    {
        return $this->price;
    }

    /**
     * @return DateTimeInterface
     */
    public function createdAt(): DateTimeInterface
    {
        return $this->createdAt;
    }
}
