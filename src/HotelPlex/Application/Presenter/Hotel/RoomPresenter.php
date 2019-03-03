<?php

declare(strict_types=1);

namespace HotelPlex\Application\Presenter\Hotel;

use HotelPlex\Application\Presenter\Presenter;
use HotelPlex\Domain\Entity\Hotel\Room\Room;

abstract class RoomPresenter implements Presenter
{
    /**
     * @var Room
     */
    protected $room;

    /**
     * @param Room $room
     * @return RoomPresenter
     */
    public function write(Room $room): self
    {
        $this->room = $room;

        return $this;
    }

    /**
     * @return mixed
     */
    public abstract function read();
}
