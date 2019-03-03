<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Presenter\Hotel;

use HotelPlex\Application\Presenter\Hotel\RoomPresenter;

class ArrayRoomPresenter extends RoomPresenter
{
    /**
     * @return mixed
     */
    public function read()
    {
        return [
            'uuid' => $this->room->uuid()->value(),
            'currency' => $this->room->currency()->value(),
            'facilities' => [
                'tv' => $this->room->facilities()->tv()->value(),
                'heating' => $this->room->facilities()->heating()->value(),
                'airConditioning' => $this->room->facilities()->airConditioning()->value(),
                'wc' => $this->room->facilities()->wc()->value(),
                'shower' => $this->room->facilities()->shower()->value(),
                'wardrobe' => $this->room->facilities()->wardrobe()->value(),
                'locker' => $this->room->facilities()->locker()->value(),
                'accessibility' => $this->room->facilities()->accessibility()->value(),
            ],
            'individualPrice' => $this->room->individualPrice()->value(),
            'individualBeds' => $this->room->individualBeds()->value(), // TODO: Check
            'doublePrice' => $this->room->doublePrice()->value(),
            'doubleBeds' => $this->room->doubleBeds()->value(), // TODO: Check
            'images' => $this->room->images()->value()
        ];
    }
}
