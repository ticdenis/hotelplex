<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Presenter\Payment;

use HotelPlex\Application\Presenter\Payment\PaymentPresenter;

class ArrayPaymentPresenter extends PaymentPresenter
{
    /**
     * @return mixed
     */
    public function read()
    {
        return [
            'uuid' => $this->payment->uuid()->value(),
            'method' => $this->payment->paymentMethod()->value(),
            'currency' => $this->payment->amount()->currency(),
            'price' => $this->payment->amount()->price(),
            'createdAt' => $this->payment->createdAt()->toUSFormat()
        ];
    }
}
