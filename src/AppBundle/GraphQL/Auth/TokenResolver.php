<?php

declare(strict_types=1);

namespace App\GraphQL\Auth;

use App\Controller\Auth\TokenPostController;
use Exception;
use GuzzleHttp\Client;
use HotelPlex\Application\Presenter\Auth\TokenPresenter;
use HotelPlex\Application\Service\Auth\TokenRequest;
use HotelPlex\Application\Service\Auth\TokenService;
use HotelPlex\Domain\ValueObject\DateTimeValueObject;
use HotelPlex\Infrastructure\Factory\ReallySimpleTokenFactory;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var bool
     */
    private $fallback = true;
    /**
     * @var string 'api' or 'controller'
     */
    private $fallbackType = 'controller';

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
     * @param Argument $args
     * @return mixed
     * @throws Exception
     */
    public function resolve(Argument $args)
    {
        if ($this->fallback) {
            return $this->fallback($args);
        }

        $userRepository = $this->container->get('hotelplex.repository.user');
        $providerRepository = $this->container->get('hotelplex.repository.provider');
        $tokenFactory = new ReallySimpleTokenFactory(
            getenv('TOKEN_SECRET'),
            DateTimeValueObject::nowModify(getenv('TOKEN_EXPIRATION_DAYS'), 'days')->value()->getTimestamp()
        );

        $service = new TokenService($userRepository, $providerRepository, $tokenFactory);

        return $service->__invoke(
            new TokenRequest(
                $args['email'],
                $args['password']
            ),
            new TokenPresenter()
        )->read();
    }

    /**
     * @param Argument $args
     * @return mixed
     * @throws Exception
     */
    private function fallback(Argument $args)
    {
        $jsonResponse = $this->fallbackType === 'api'
            ? $this->fetchJSONResponseFromAPI($args)
            : $this->fetchJSONResponseFromController($args);

        $json = json_decode($jsonResponse->getContent());

        if ($jsonResponse->getStatusCode() !== Response::HTTP_CREATED) {
            throw new Exception($json->error);
        }

        return $json->token;
    }

    /**
     * @param Argument $args
     * @return JsonResponse
     */
    private function fetchJSONResponseFromController(Argument $args): JsonResponse
    {
        $request = new Request([], [
            'email' => $args['email'],
            'password' => $args['password']
        ]);

        $controller = new TokenPostController($this->container);

        return $controller->__invoke($request);
    }

    /**
     * @param Argument $args
     * @return ResponseInterface
     */
    private function fetchJSONResponseFromAPI(Argument $args): ResponseInterface
    {
        $client = new Client([
            'base_uri' => 'http://hotelplex-nginx'
        ]);

        return $client->post('/auth/token', [
            'email' => $args['email'],
            'password' => $args['password']
        ]);
    }

    public static function getAliases()
    {
        return [
            'resolve' => 'TokenResolver'
        ];
    }
}
