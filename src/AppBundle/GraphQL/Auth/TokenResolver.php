<?php

declare(strict_types=1);

namespace App\GraphQL\Auth;

use HotelPlex\Application\Presenter\Auth\TokenPresenter;
use HotelPlex\Application\Service\Auth\TokenRequest;
use HotelPlex\Application\Service\Auth\TokenService;
use HotelPlex\Domain\Exception\Auth\AuthException;
use HotelPlex\Domain\ValueObject\DateTimeValueObject;
use HotelPlex\Infrastructure\Factory\ReallySimpleTokenFactory;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Psr\Container\ContainerInterface;

class TokenResolver implements ResolverInterface, AliasedInterface
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
     * @param Argument $args
     * @return mixed
     * @throws AuthException
     */
    public function resolve(Argument $args)
    {
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

    public static function getAliases()
    {
        return [
            'resolve' => 'TokenResolver'
        ];
    }
}
