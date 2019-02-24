<?php

declare(strict_types=1);

namespace HotelPlex\Application\Mapper\Payment;

use HotelPlex\Application\Mapper\Mapper;
use HotelPlex\Application\Mapper\MapperSanitizeTrait;
use HotelPlex\Domain\Entity\Payment\Payment;

abstract class PaymentMapper implements Mapper
{
    use MapperSanitizeTrait;

    /**
     * @return string
     */
    final public function entity(): string
    {
        return Payment::class;
    }

    /**
     * @param $source
     * @return Payment
     */
    abstract function item($source);

    /**
     * @param array $sources
     * @return Payment[]
     */
    abstract function items(array $sources);
}
