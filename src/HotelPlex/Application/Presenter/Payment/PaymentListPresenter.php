<?php

declare(strict_types=1);

namespace HotelPlex\Application\Presenter\Payment;

use HotelPlex\Application\Presenter\Presenter;
use HotelPlex\Domain\Entity\Payment\Payment;

abstract class PaymentListPresenter implements Presenter
{
    /**
     * @var Payment[]
     */
    protected $payments;

    /**
     * @param Payment[] $payments
     * @return PaymentListPresenter
     */
    public function write(array $payments): self
    {
        $this->payments = $payments;

        return $this;
    }

    /**
     * @return mixed
     */
    public abstract function read();
}
