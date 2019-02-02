<?php

declare(strict_types=1);

namespace HotelPlex\Application\Presenter\Hotel;

use HotelPlex\Application\Presenter\Presenter;
use HotelPlex\Domain\Entity\Hotel\Hotel;

abstract class HotelPresenter implements Presenter
{
    /**
     * @var Hotel
     */
    protected $hotel;

    /**
     * @param Hotel $hotel
     * @return HotelPresenter
     */
    public function write(Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * @return mixed
     */
    public abstract function read();
}
