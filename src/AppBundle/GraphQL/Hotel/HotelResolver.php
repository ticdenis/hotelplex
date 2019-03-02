<?php

declare(strict_types=1);

namespace App\GraphQL\Hotel;

use App\GraphQL\BaseResolver;
use HotelPlex\Application\Service\Hotel\HotelRequest;
use HotelPlex\Application\Service\Hotel\HotelService;
use HotelPlex\Infrastructure\Presenter\Hotel\ArrayHotelPresenter;
use Overblog\GraphQLBundle\Definition\Argument;

class HotelResolver extends BaseResolver
{
    /**
     * @param Argument $args
     * @return mixed
     */
    public function resolve(Argument $args)
    {
        return (new HotelService(
            $this->container->get('hotelplex.query-repository.hotel')
        ))(
            new HotelRequest($args['uuid']),
            new ArrayHotelPresenter()
        )->read();
    }
}
