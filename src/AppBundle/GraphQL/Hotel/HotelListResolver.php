<?php

declare(strict_types=1);

namespace App\GraphQL\Hotel;

use App\GraphQL\BaseResolver;
use HotelPlex\Application\Service\EmptyRequest;
use HotelPlex\Application\Service\Hotel\HotelListService;
use HotelPlex\Infrastructure\Presenter\Hotel\ArrayHotelListPresenter;
use HotelPlex\Infrastructure\Presenter\Hotel\ArrayHotelPresenter;
use Overblog\GraphQLBundle\Definition\Argument;

class HotelListResolver extends BaseResolver
{
    /**
     * @param Argument $args
     * @return mixed
     */
    public function resolve(Argument $args)
    {
        return (new HotelListService(
            $this->container->get('hotelplex.query-repository.hotel')
        ))(
            new EmptyRequest(),
            new ArrayHotelListPresenter(new ArrayHotelPresenter())
        )->read();
    }
}
