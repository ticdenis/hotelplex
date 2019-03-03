<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Presenter\Hotel;

use HotelPlex\Application\Presenter\Hotel\HotelPresenter;

class ArrayHotelPresenter extends HotelPresenter
{
    /**
     * @return mixed
     */
    public function read()
    {
        return [
            'uuid' => $this->hotel->uuid()->value(),
            'name' => $this->hotel->name()->value(),
            'address' => $this->hotel->address()->value(),
            'phone' => $this->hotel->phone()->value(),
            'email' => $this->hotel->email()->value(),
            'lift' => $this->hotel->lift()->value(),
            'wifi' => $this->hotel->wifi()->value(),
            'accessibility' => $this->hotel->accessibility()->value(),
            'parking' => $this->hotel->parking()->value(),
            'kitchen' => $this->hotel->kitchen()->value(),
            'pets' => $this->hotel->pets()->value(),
            'paymentMethods' => $this->hotel->paymentMethods()->value(),
            'logo' => $this->hotel->logo()->value(),
            'images' => $this->hotel->images()->value()
        ];
    }
}
