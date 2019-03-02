<?php

declare(strict_types=1);

namespace App\Controller\Payment;

use App\Controller\BaseController;
use HotelPlex\Application\Service\EmptyRequest;
use HotelPlex\Application\Service\Payment\PaymentListService;
use HotelPlex\Infrastructure\Presenter\Payment\ArrayPaymentListPresenter;
use HotelPlex\Infrastructure\Presenter\Payment\ArrayPaymentPresenter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class PaymentListGetController extends BaseController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse((new PaymentListService(
            $this->container->get('hotelplex.query-repository.payment')
        ))(
            new EmptyRequest(),
            new ArrayPaymentListPresenter(new ArrayPaymentPresenter())
        )->read(), JsonResponse::HTTP_OK);
    }
}
