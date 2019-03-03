<?php

declare(strict_types=1);

namespace HotelPlex\Application\Presenter\Hotel;

use HotelPlex\Application\Presenter\Presenter;
use HotelPlex\Domain\Entity\Hotel\Room\Room;

abstract class RoomListPresenter implements Presenter
{
    /**
     * @var Room[]
     */
    protected $rooms;

    /**
     * @param Room[] $rooms
     * @return RoomListPresenter
     */
    public function write(array $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    /**
     * @return mixed
     */
    public abstract function read();
}
