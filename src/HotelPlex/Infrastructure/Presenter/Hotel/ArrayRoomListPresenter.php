<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Presenter\Hotel;

use HotelPlex\Application\Presenter\Hotel\RoomListPresenter;
use HotelPlex\Application\Presenter\Hotel\RoomPresenter;
use function Lambdish\Phunctional\map;

class ArrayRoomListPresenter extends RoomListPresenter
{
    /**
     * @var RoomPresenter
     */
    private $presenter;

    /**
     * @param RoomPresenter $presenter
     */
    public function __construct(RoomPresenter $presenter)
    {
        $this->presenter = $presenter;
    }

    /**
     * @return mixed
     */
    public function read()
    {
        $presenter = $this->presenter;

        return map(function ($room) use ($presenter) {
            return $presenter->write($room)->read();
        }, $this->rooms);
    }
}
