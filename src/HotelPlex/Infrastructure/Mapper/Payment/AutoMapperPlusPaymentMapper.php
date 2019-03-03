<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Mapper\Payment;

use AutoMapperPlus\Configuration\AutoMapperConfig;
use HotelPlex\Application\Mapper\Payment\PaymentMapper;
use HotelPlex\Domain\Entity\Payment\PaymentAmount;
use HotelPlex\Domain\Entity\Payment\PaymentCreatedAt;
use HotelPlex\Domain\Entity\Payment\PaymentId;
use HotelPlex\Domain\Entity\Payment\PaymentMethod;
use HotelPlex\Infrastructure\Mapper\AutoMapperPlusTrait;
use stdClass;

class AutoMapperPlusPaymentMapper extends PaymentMapper
{
    use AutoMapperPlusTrait;

    /**
     * @return AutoMapperConfig
     */
    protected function config(): AutoMapperConfig
    {
        $config = new AutoMapperConfig();

        $config->registerMapping(stdClass::class, $this->entity())
            ->forMember('uuid', function ($item) {
                return new PaymentId($item->uuid);
            })
            ->forMember('paymentMethod', function ($item) {
                return new PaymentMethod($item->payment_method);
            })
            ->forMember('amount', function ($item) {
                return new PaymentAmount($item->currency, floatval($item->price));
            })
            ->forMember('createdAt', function ($item) {
                if (!isset($item->created_at)) {
                    return PaymentCreatedAt::now();
                } else if (is_integer($item->created_at)) {
                    return PaymentCreatedAt::fromInt($item->created_at);
                } else {
                    return PaymentCreatedAt::fromString($item->created_at);
                }
            });

        return $config;
    }
}
