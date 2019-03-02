<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Factory\Payment;

use HotelPlex\Domain\Entity\Payment\Payment;

interface PaymentFactory
{
    /**
     * @param array $source Constructor params.
     * @return Payment
     */
    public function build(array $source): Payment;
}
