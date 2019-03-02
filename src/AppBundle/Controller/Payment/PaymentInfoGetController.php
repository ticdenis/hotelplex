<?php

declare(strict_types=1);

namespace App\Controller\Payment;

use App\Controller\BaseController;
use HotelPlex\Application\Service\Payment\PaymentInfoRequest;
use HotelPlex\Application\Service\Payment\PaymentInfoService;
use HotelPlex\Infrastructure\Presenter\Payment\ArrayPaymentPresenter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class PaymentInfoGetController extends BaseController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse((new PaymentInfoService(
            $this->container->get('hotelplex.query-repository.payment')
        ))(
            new PaymentInfoRequest($request->get('uuid')),
            new ArrayPaymentPresenter()
        )->read(), JsonResponse::HTTP_OK);
    }
}
