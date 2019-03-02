<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service\Payment;

use HotelPlex\Application\Service\Request;
use HotelPlex\Domain\Entity\Payment\PaymentId;
use HotelPlex\Domain\ValueObject\UuidValueObject;

class PaymentInfoRequest implements Request
{
    /**
     * @var UuidValueObject
     */
    private $uuid;

    /**
     * @param string $uuid
     */
    public function __construct(string $uuid)
    {
        $this->uuid = new PaymentId($uuid);
    }

    /**
     * @return PaymentId
     */
    public function uuid(): PaymentId
    {
        return $this->uuid;
    }
}
