<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use DateTime;
use HotelPlex\Application\Presenter\Auth\TokenPresenter;
use HotelPlex\Application\Service\Auth\TokenRequest;
use HotelPlex\Application\Service\Auth\TokenService;
use HotelPlex\Domain\Exception\Auth\AuthException;
use HotelPlex\Infrastructure\Factory\ReallySimpleTokenFactory;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class TokenPostController
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function __invoke(Request $request)
    {
        $userRepository = $this->container->get('hotelplex.repository.user');
        $providerRepository = $this->container->get('hotelplex.repository.provider');
        $tokenFactory = new ReallySimpleTokenFactory('secret123456A*', (new DateTime())->modify('+14 days'));

        $service = new TokenService($userRepository, $providerRepository, $tokenFactory);

        try {
            $token = $service->__invoke(
                new TokenRequest(
                    $request->get('email'),
                    $request->get('password')
                ),
                new TokenPresenter()
            )->read();

            return new JsonResponse([
                'token' => $token
            ], Response::HTTP_CREATED);
        } catch (AuthException $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage()
            ], $exception->getCode());
        }
    }

}
