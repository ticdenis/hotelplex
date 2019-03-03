<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Mapper\Hotel;

use AutoMapperPlus\Configuration\AutoMapperConfig;
use HotelPlex\Application\Mapper\Hotel\RoomFacilitiesMapper;
use HotelPlex\Application\Mapper\Hotel\RoomMapper;
use HotelPlex\Domain\Entity\Hotel\Room\RoomCurrency;
use HotelPlex\Domain\Entity\Hotel\Room\RoomDoubleBeds;
use HotelPlex\Domain\Entity\Hotel\Room\RoomId;
use HotelPlex\Domain\Entity\Hotel\Room\RoomImages;
use HotelPlex\Domain\Entity\Hotel\Room\RoomIndividualBeds;
use HotelPlex\Domain\Entity\Hotel\Room\RoomIndividualPrice;
use HotelPlex\Infrastructure\Mapper\AutoMapperPlusTrait;
use stdClass;
use function Lambdish\Phunctional\map;

class AutoMapperPlusRoomMapper extends RoomMapper
{
    use AutoMapperPlusTrait;

    /**
     * @var RoomFacilitiesMapper
     */
    private $facilitiesMapper;

    public function __construct(RoomFacilitiesMapper $facilitiesMapper)
    {
        $this->facilitiesMapper = $facilitiesMapper;
    }

    /**
     * @return AutoMapperConfig
     */
    protected function config(): AutoMapperConfig
    {
        $config = new AutoMapperConfig();

        $config->registerMapping(stdClass::class, $this->entity())
            ->forMember('uuid', function ($item) {
                return new RoomId($item->uuid);
            })
            ->forMember('currency', function ($item) {
                return new RoomCurrency($item->currency);
            })
            ->forMember('facilities', function ($item) {
                return $this->facilitiesMapper->item(!isset($item->facilities) ? new stdClass() : $item->facilities);
            })
            ->forMember('individualPrice', function ($item) {
                return new RoomIndividualPrice(!isset($item->individualPrice) ? 0 : $item->individualPrice);
            })
            ->forMember('individualBeds', function ($item) {
                return new RoomIndividualBeds(!isset($item->individualBeds) ? [] : $item->individualBeds);
            })
            ->forMember('doublePrice', function ($item) {
                return new RoomIndividualPrice(!isset($item->doublePrice) ? 0 : $item->doublePrice);
            })
            ->forMember('doubleBeds', function ($item) {
                return new RoomDoubleBeds(!isset($item->doubleBeds) ? [] : $item->doubleBeds);
            })
            ->forMember('images', function ($item) {
                return new RoomImages(!isset($item->images) ? [] : map(function ($image) {
                    return $image->filename;
                }, $item->images));
            });

        return $config;
    }
}
