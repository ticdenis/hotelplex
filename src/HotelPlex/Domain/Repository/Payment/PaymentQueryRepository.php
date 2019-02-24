<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Repository\Payment;

use HotelPlex\Domain\Entity\Payment\Payment;

interface PaymentQueryRepository
{
    /**
     * @return Payment[]
     */
    public function all(): array;
}
