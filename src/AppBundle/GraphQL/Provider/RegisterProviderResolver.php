<?php

declare(strict_types=1);

namespace App\GraphQL\Provider;

use HotelPlex\Application\Presenter\EmptyPresenter;
use HotelPlex\Application\Service\Hotel\HotelRequest;
use HotelPlex\Application\Service\Hotel\HotelService;
use HotelPlex\Application\Service\Provider\ProviderRegisterRequest;
use HotelPlex\Application\Service\Provider\RegisterProviderService;
use HotelPlex\Domain\Exception\Hotel\HotelNotFoundException;
use HotelPlex\Infrastructure\Presenter\ArrayHotelPresenter;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Psr\Container\ContainerInterface;
use Tasky\Domain\Model\Provider\ProviderInvalidEmailException;

class RegisterProviderResolver implements ResolverInterface, AliasedInterface
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
     * @throws HotelNotFoundException
     * @throws ProviderInvalidEmailException
     */
    public function resolve(Argument $args)
    {
        $repository = $this->container->get('hotelplex.repository.provider');

        $request = new ProviderRegisterRequest(
            $args['uuid'],
            $args['username'],
            $args['email'],
            $args['password']
        );

        $service = new RegisterProviderService($repository);
        $presenter = new EmptyPresenter();

        $service->__invoke($request, $presenter);

        return true;
    }

    public static function getAliases()
    {
        return [
            'resolve' => 'RegisterProviderResolver'
        ];
    }
}
