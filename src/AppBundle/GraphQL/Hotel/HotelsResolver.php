<?php

declare(strict_types=1);

namespace App\GraphQL\Hotel;

use App\GraphQL\BaseResolver;
use HotelPlex\Application\Service\EmptyRequest;
use HotelPlex\Application\Service\Hotel\HotelListService;
use HotelPlex\Infrastructure\Presenter\ArrayHotelListPresenter;
use HotelPlex\Infrastructure\Presenter\ArrayHotelPresenter;
use Overblog\GraphQLBundle\Definition\Argument;

class HotelsResolver extends BaseResolver
{
    /**
     * @param Argument $args
     * @return mixed
     */
    public function resolve(Argument $args)
    {
        return (new HotelListService(
            $this->container->get('hotelplex.repository.hotel')
        ))(
            new EmptyRequest(),
            new ArrayHotelListPresenter(new ArrayHotelPresenter())
        )->read();
    }
}
