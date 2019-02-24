<?php

declare(strict_types=1);

namespace HotelPlex\Application\Presenter\Payment;

use HotelPlex\Application\Presenter\Presenter;
use HotelPlex\Domain\Entity\Payment\Payment;

abstract class PaymentPresenter implements Presenter
{
    /**
     * @var Payment
     */
    protected $payment;

    /**
     * @param Payment $payment
     * @return PaymentPresenter
     */
    public function write(Payment $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * @return mixed
     */
    public abstract function read();
}
