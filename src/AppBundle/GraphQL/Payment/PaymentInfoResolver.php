<?php

declare(strict_types=1);

namespace App\GraphQL\Payment;

use App\GraphQL\BaseResolver;
use HotelPlex\Application\Service\Payment\PaymentInfoRequest;
use HotelPlex\Application\Service\Payment\PaymentInfoService;
use HotelPlex\Infrastructure\Presenter\Payment\ArrayPaymentPresenter;
use Overblog\GraphQLBundle\Definition\Argument;

class PaymentInfoResolver extends BaseResolver
{
    /**
     * @param Argument $args
     * @return mixed
     */
    public function resolve(Argument $args)
    {
        return (new PaymentInfoService(
            $this->container->get('hotelplex.query-repository.payment')
        ))(
            new PaymentInfoRequest($args['uuid']),
            new ArrayPaymentPresenter()
        )->read();
    }
}
