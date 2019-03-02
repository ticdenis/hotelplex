<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Repository\Payment;

use HotelPlex\Domain\Entity\Payment\Payment;
use HotelPlex\Domain\Entity\Payment\PaymentId;

interface PaymentQueryRepository
{
    /**
     * @return Payment[]
     */
    public function all(): array;

    /**
     * @param PaymentId $id
     * @return Payment|null
     */
    public function ofId(PaymentId $id): ?Payment;
}
