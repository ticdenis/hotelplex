<?php

declare(strict_types=1);

namespace App\Controller\Hotel;

use App\Controller\BaseController;
use HotelPlex\Application\Service\EmptyRequest;
use HotelPlex\Application\Service\Hotel\HotelListService;
use HotelPlex\Infrastructure\Presenter\Hotel\ArrayHotelListPresenter;
use HotelPlex\Infrastructure\Presenter\Hotel\ArrayHotelPresenter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class HotelListGetController extends BaseController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse((new HotelListService(
            $this->container->get('hotelplex.query-repository.hotel')
        ))(
            new EmptyRequest(),
            new ArrayHotelListPresenter(new ArrayHotelPresenter())
        )->read(), JsonResponse::HTTP_OK);
    }
}
