<?php

declare(strict_types=1);

namespace App\GraphQL\Resolver;

use HotelPlex\Application\Service\Hotel\HotelRequest;
use HotelPlex\Application\Service\Hotel\HotelService;
use HotelPlex\Domain\Exception\Hotel\HotelNotFoundException;
use HotelPlex\Infrastructure\Presenter\ArrayHotelPresenter;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Psr\Container\ContainerInterface;

class HotelResolver implements ResolverInterface, AliasedInterface
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
     */
    public function resolve(Argument $args)
    {
        $repository = $this->container->get('hotelplex.repository.hotel');
        $request = new HotelRequest($args['uuid']);
        $service = new HotelService($repository);
        $presenter = new ArrayHotelPresenter();

        return $service->execute($request, $presenter)->read();
    }

    public static function getAliases()
    {
        return [
            'resolve' => 'HotelResolver'
        ];
    }
}
