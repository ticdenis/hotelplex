<?php

declare(strict_types=1);

namespace App\Controller\Hotel;

use App\Controller\BaseController;
use HotelPlex\Application\Service\Hotel\HotelRequest;
use HotelPlex\Application\Service\Hotel\HotelService;
use HotelPlex\Infrastructure\Presenter\Hotel\ArrayHotelPresenter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class HotelGetController extends BaseController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse((new HotelService(
            $this->container->get('hotelplex.query-repository.hotel')
        ))(
            new HotelRequest($request->get('uuid')),
            new ArrayHotelPresenter()
        )->read(), JsonResponse::HTTP_OK);
    }
}
