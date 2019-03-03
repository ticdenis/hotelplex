<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Mapper\Hotel;

use AutoMapperPlus\Configuration\AutoMapperConfig;
use HotelPlex\Application\Mapper\Hotel\RoomFacilitiesMapper;
use HotelPlex\Domain\Entity\Hotel\Room\RoomAccessibility;
use HotelPlex\Domain\Entity\Hotel\Room\RoomAirConditioning;
use HotelPlex\Domain\Entity\Hotel\Room\RoomHeating;
use HotelPlex\Domain\Entity\Hotel\Room\RoomLocker;
use HotelPlex\Domain\Entity\Hotel\Room\RoomShower;
use HotelPlex\Domain\Entity\Hotel\Room\RoomTv;
use HotelPlex\Domain\Entity\Hotel\Room\RoomWardrobe;
use HotelPlex\Domain\Entity\Hotel\Room\RoomWc;
use HotelPlex\Infrastructure\Mapper\AutoMapperPlusTrait;
use stdClass;

class AutoMapperPlusRoomFacilitiesMapper extends RoomFacilitiesMapper
{
    use AutoMapperPlusTrait;

    /**
     * @return AutoMapperConfig
     */
    protected function config(): AutoMapperConfig
    {
        $config = new AutoMapperConfig();

        $config->registerMapping(stdClass::class, $this->entity())
            ->forMember('tv', function ($item) {
                return new RoomTv(!isset($item->tv) ? false : (bool)$item->tv);
            })
            ->forMember('heating', function ($item) {
                return new RoomHeating(!isset($item->heating) ? false : (bool)$item->heating);
            })
            ->forMember('airConditioning', function ($item) {
                return new RoomAirConditioning(!isset($item->airConditioning) ? false : (bool)$item->airConditioning);
            })
            ->forMember('wc', function ($item) {
                return new RoomWc(!isset($item->wc) ? false : (bool)$item->wc);
            })
            ->forMember('shower', function ($item) {
                return new RoomShower(!isset($item->shower) ? false : (bool)$item->shower);
            })
            ->forMember('wardrobe', function ($item) {
                return new RoomWardrobe(!isset($item->wardrobe) ? false : (bool)$item->wardrobe);
            })
            ->forMember('locker', function ($item) {
                return new RoomLocker(!isset($item->locker) ? false : (bool)$item->locker);
            })
            ->forMember('accessibility', function ($item) {
                return new RoomAccessibility(!isset($item->accessibility) ? false : (bool)$item->accessibility);
            });

        return $config;
    }
}
