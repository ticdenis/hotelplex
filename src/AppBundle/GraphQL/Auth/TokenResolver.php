<?php

declare(strict_types=1);

namespace App\GraphQL\Auth;

use App\Controller\Auth\TokenPostController;
use App\GraphQL\BaseResolver;
use Exception;
use GuzzleHttp\Client;
use HotelPlex\Application\Presenter\Auth\TokenPresenter;
use HotelPlex\Application\Service\Auth\TokenRequest;
use HotelPlex\Application\Service\Auth\TokenService;
use HotelPlex\Domain\ValueObject\DateTimeValueObject;
use HotelPlex\Infrastructure\Factory\ReallySimpleTokenFactory;
use Overblog\GraphQLBundle\Definition\Argument;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenResolver extends BaseResolver
{
    /**
     * @var bool
     */
    private $fallback = false;
    /**
     * @var string 'api' or 'controller'
     */
    private $fallbackType = 'controller';

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

        return (new TokenService(
            $this->container->get('hotelplex.query-repository.user'),
            $this->container->get('hotelplex.query-repository.provider'),
            new ReallySimpleTokenFactory(
                getenv('TOKEN_SECRET'),
                DateTimeValueObject::nowModify(getenv('TOKEN_EXPIRATION_DAYS'), 'days')->value()->getTimestamp()
            )
        ))(
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
}
