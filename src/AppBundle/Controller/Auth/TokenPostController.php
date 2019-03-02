<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use App\Controller\BaseController;
use Exception;
use HotelPlex\Application\Presenter\Auth\TokenPresenter;
use HotelPlex\Application\Service\Auth\TokenRequest;
use HotelPlex\Application\Service\Auth\TokenService;
use HotelPlex\Domain\ValueObject\DateTimeValueObject;
use HotelPlex\Infrastructure\Factory\ReallySimpleTokenFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class TokenPostController extends BaseController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {
            return new JsonResponse([
                'token' => (new TokenService(
                    $this->container->get('hotelplex.query-repository.user'),
                    $this->container->get('hotelplex.query-repository.provider'),
                    new ReallySimpleTokenFactory(
                        getenv('TOKEN_SECRET'),
                        DateTimeValueObject::nowModify(getenv('TOKEN_EXPIRATION_DAYS'), 'days')->value()->getTimestamp()
                    )
                ))(
                    new TokenRequest(
                        $request->get('email'),
                        $request->get('password')
                    ),
                    new TokenPresenter()
                )->read()
            ], JsonResponse::HTTP_CREATED);
        } catch (Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage()
            ], $exception->getCode());
        }
    }
}
