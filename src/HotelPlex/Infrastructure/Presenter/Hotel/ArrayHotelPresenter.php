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
            'name' => $this->hotel->name(),
            'address' => $this->hotel->address(),
            'phone' => $this->hotel->phone(),
            'email' => $this->hotel->email(),
            'lift' => $this->hotel->lift(),
            'wifi' => $this->hotel->wifi(),
            'accessibility' => $this->hotel->accessibility(),
            'parking' => $this->hotel->parking(),
            'kitchen' => $this->hotel->kitchen(),
            'pets' => $this->hotel->pets(),
            'paymentMethods' => $this->hotel->paymentMethods(),
            'logo' => $this->hotel->logo(),
            'images' => $this->hotel->images()
        ];
    }
}
