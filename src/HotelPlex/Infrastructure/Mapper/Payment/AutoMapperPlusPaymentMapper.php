<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Mapper\Payment;

use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use HotelPlex\Application\Mapper\Payment\PaymentMapper;
use HotelPlex\Domain\Entity\Payment\Payment;
use HotelPlex\Domain\Entity\Payment\PaymentAmount;
use HotelPlex\Domain\Entity\Payment\PaymentCreatedAt;
use HotelPlex\Domain\Entity\Payment\PaymentId;
use HotelPlex\Domain\Entity\Payment\PaymentMethod;
use stdClass;

class AutoMapperPlusPaymentMapper extends PaymentMapper
{
    /**
     * @var AutoMapper
     */
    private $mapper;

    public function __construct()
    {
        $this->mapper = new AutoMapper($this->config());
    }

    /** @noinspection PhpDocMissingThrowsInspection */
    /**
     * @param $source
     * @return Payment
     */
    public function item($source)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return $this->mapper->map($this->sanitize($source), $this->entity());
    }

    /** @noinspection PhpDocMissingThrowsInspection */
    /**
     * @param array $sources
     * @return Payment[]
     */
    public function items(array $sources)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return $this->mapper->mapMultiple($this->sanitize($sources), $this->entity());
    }

    /**
     * @return AutoMapperConfig
     */
    private function config(): AutoMapperConfig
    {
        $config = new AutoMapperConfig();

        $config->registerMapping(stdClass::class, $this->entity())
            ->forMember('uuid', function ($item) {
                return new PaymentId($item->uuid ?? $item->id);
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
                } else if (($timestamp = (int)$item->created_at) !== 0) {
                    return PaymentCreatedAt::fromInt($timestamp);
                } else {
                    return PaymentCreatedAt::fromString($item->created_at);
                }
            });

        return $config;
    }
}
