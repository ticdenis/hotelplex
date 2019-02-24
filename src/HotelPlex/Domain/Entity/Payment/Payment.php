<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Entity\Payment;

use HotelPlex\Domain\Event\DomainEventPublisher;
use HotelPlex\Domain\Event\Payment\PaymentCreated;

class Payment
{
    /**
     * @var PaymentId
     */
    private $uuid;
    /**
     * @var PaymentMethod
     */
    private $paymentMethod;
    /**
     * @var PaymentAmount
     */
    private $amount;
    /**
     * @var PaymentCreatedAt
     */
    private $createdAt;

    /**
     * @param PaymentId $uuid
     * @param PaymentMethod $paymentMethod
     * @param PaymentAmount $amount
     * @param PaymentCreatedAt $createdAt
     */
    public function __construct(
        PaymentId $uuid,
        PaymentMethod $paymentMethod,
        PaymentAmount $amount,
        PaymentCreatedAt $createdAt
    )
    {
        $this->uuid = $uuid;
        $this->paymentMethod = $paymentMethod;
        $this->amount = $amount;
        $this->createdAt = $createdAt;
    }

    /**
     * @param PaymentId $uuid
     * @param PaymentMethod $paymentMethod
     * @param PaymentAmount $amount
     * @param PaymentCreatedAt $createdAt
     * @return Payment
     */
    public static function create(
        PaymentId $uuid,
        PaymentMethod $paymentMethod,
        PaymentAmount $amount,
        PaymentCreatedAt $createdAt
    ): self
    {
        $payment = new self($uuid, $paymentMethod, $amount, $createdAt);

        DomainEventPublisher::instance()->publish(
            new PaymentCreated(
                $uuid->value(),
                $paymentMethod,
                $amount->currency(),
                $amount->price(),
                $createdAt->value()
            )
        );

        return $payment;
    }

    /**
     * @return PaymentId
     */
    public function uuid(): PaymentId
    {
        return $this->uuid;
    }

    /**
     * @return PaymentMethod
     */
    public function paymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    /**
     * @return PaymentAmount
     */
    public function amount(): PaymentAmount
    {
        return $this->amount;
    }

    /**
     * @return PaymentCreatedAt
     */
    public function createdAt(): PaymentCreatedAt
    {
        return $this->createdAt;
    }
}
