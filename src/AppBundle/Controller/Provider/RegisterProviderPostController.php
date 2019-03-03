<?php

declare(strict_types=1);

namespace App\Controller\Provider;

use App\Controller\BaseController;
use HotelPlex\Application\Presenter\EmptyPresenter;
use HotelPlex\Application\Service\Provider\ProviderRegisterRequest;
use HotelPlex\Application\Service\Provider\RegisterProviderService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class RegisterProviderPostController extends BaseController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        (new RegisterProviderService(
            $this->container->get('hotelplex.command-repository.provider')
        ))(
            new ProviderRegisterRequest(
                $request->get('uuid'),
                $request->get('username'),
                $request->get('email'),
                $request->get('password')
            ),
            new EmptyPresenter()
        );

        return new JsonResponse(null, JsonResponse::HTTP_CREATED);
    }
}
