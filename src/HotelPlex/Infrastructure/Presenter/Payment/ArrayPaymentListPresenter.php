<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Presenter\Payment;

use HotelPlex\Application\Presenter\Payment\PaymentListPresenter;
use HotelPlex\Application\Presenter\Payment\PaymentPresenter;
use function Lambdish\Phunctional\map;

class ArrayPaymentListPresenter extends PaymentListPresenter
{
    /**
     * @var PaymentPresenter
     */
    private $presenter;

    /**
     * @param PaymentPresenter $presenter
     */
    public function __construct(PaymentPresenter $presenter)
    {
        $this->presenter = $presenter;
    }

    /**
     * @return mixed
     */
    public function read()
    {
        $presenter = $this->presenter;

        return map(function ($hotel) use ($presenter) {
            return $presenter->write($hotel)->read();
        }, $this->payments);
    }
}
