<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Controller\BaseController;
use Exception;
use HotelPlex\Application\Presenter\EmptyPresenter;
use HotelPlex\Application\Service\User\RegisterUserRequest;
use HotelPlex\Application\Service\User\RegisterUserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class RegisterUserPostController extends BaseController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {
            (new RegisterUserService(
                $this->container->get('hotelplex.command-repository.user')
            ))(
                new RegisterUserRequest(
                    $request->get('uuid'),
                    $request->get('username'),
                    $request->get('email'),
                    $request->get('password'),
                    $request->get('hotels')
                ),
                new EmptyPresenter()
            );

            return new JsonResponse(null, JsonResponse::HTTP_CREATED);
        } catch (Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage()
            ], $exception->getCode());
        }
    }
}
