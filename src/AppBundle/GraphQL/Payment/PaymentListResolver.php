<?php

declare(strict_types=1);

namespace App\GraphQL\Payment;

use App\GraphQL\BaseResolver;
use HotelPlex\Application\Service\EmptyRequest;
use HotelPlex\Application\Service\Payment\PaymentListService;
use HotelPlex\Infrastructure\Presenter\Payment\ArrayPaymentListPresenter;
use HotelPlex\Infrastructure\Presenter\Payment\ArrayPaymentPresenter;
use Overblog\GraphQLBundle\Definition\Argument;

class PaymentListResolver extends BaseResolver
{
    /**
     * @param Argument $args
     * @return mixed
     */
    public function resolve(Argument $args)
    {
        return (new PaymentListService(
            $this->container->get('hotelplex.query-repository.payment')
        ))(
            new EmptyRequest(),
            new ArrayPaymentListPresenter(new ArrayPaymentPresenter())
        )->read();
    }
}
