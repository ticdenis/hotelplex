<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Presenter\Hotel;

use HotelPlex\Application\Presenter\Hotel\HotelListPresenter;
use HotelPlex\Application\Presenter\Hotel\HotelPresenter;
use function Lambdish\Phunctional\map;

class ArrayHotelListPresenter extends HotelListPresenter
{
    /**
     * @var HotelPresenter
     */
    private $presenter;

    /**
     * @param HotelPresenter $presenter
     */
    public function __construct(HotelPresenter $presenter)
    {
        $this->presenter = $presenter;
    }

    /**
     * @return mixed
     */
    public function read()
    {
        $presenter = $this->presenter;

        return map(function ($hotel) use ($presenter) {
            return $presenter->write($hotel)->read();
        }, $this->hotels);
    }
}
