<?php

declare(strict_types=1);

namespace HotelPlex\Application\Presenter\Hotel;

use HotelPlex\Application\Presenter\Presenter;
use HotelPlex\Domain\Entity\Hotel\Hotel;

abstract class HotelListPresenter implements Presenter
{
    /**
     * @var Hotel[]
     */
    protected $hotels;

    /**
     * @param Hotel[] $hotels
     * @return HotelListPresenter
     */
    public function write(array $hotels): self
    {
        $this->hotels = $hotels;

        return $this;
    }

    /**
     * @return mixed
     */
    public abstract function read();
}
