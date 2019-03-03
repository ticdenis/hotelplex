<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Mapper\Hotel;

use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use HotelPlex\Application\Mapper\Hotel\HotelMapper;
use HotelPlex\Domain\Entity\Hotel\Hotel;
use HotelPlex\Domain\Entity\Hotel\HotelAccessibility;
use HotelPlex\Domain\Entity\Hotel\HotelAddress;
use HotelPlex\Domain\Entity\Hotel\HotelEmail;
use HotelPlex\Domain\Entity\Hotel\HotelId;
use HotelPlex\Domain\Entity\Hotel\HotelImages;
use HotelPlex\Domain\Entity\Hotel\HotelKitchen;
use HotelPlex\Domain\Entity\Hotel\HotelLift;
use HotelPlex\Domain\Entity\Hotel\HotelLogo;
use HotelPlex\Domain\Entity\Hotel\HotelName;
use HotelPlex\Domain\Entity\Hotel\HotelParking;
use HotelPlex\Domain\Entity\Hotel\HotelPaymentMethods;
use HotelPlex\Domain\Entity\Hotel\HotelPets;
use HotelPlex\Domain\Entity\Hotel\HotelPhone;
use HotelPlex\Domain\Entity\Hotel\HotelWifi;
use stdClass;
use function Lambdish\Phunctional\map;

class AutoMapperPlusHotelMapper extends HotelMapper
{
    /**
     * @var AutoMapper
     */
    private $mapper;

    public function __construct()
    {
        $this->mapper = new AutoMapper($this->config());
    }

    /** @noinspection PhpDocMissingThrowsInspection */
    /**
     * @param $source
     * @return Hotel
     */
    public function item($source)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return $this->mapper->map($this->sanitize($source), $this->entity());
    }

    /** @noinspection PhpDocMissingThrowsInspection */
    /**
     * @param array $sources
     * @return Hotel[]
     */
    public function items(array $sources)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return $this->mapper->mapMultiple($this->sanitize($sources), $this->entity());
    }

    /**
     * @return AutoMapperConfig
     */
    private function config(): AutoMapperConfig
    {
        $config = new AutoMapperConfig();

        $config->registerMapping(stdClass::class, $this->entity())
            ->forMember('uuid', function ($item) {
                return new HotelId($item->uuid);
            })
            ->forMember('name', function ($item) {
                return !isset($item->name) ? '' : new HotelName($item->name);
            })
            ->forMember('address', function ($item) {
                return !isset($item->address) ? '' : new HotelAddress($item->address);
            })
            ->forMember('phone', function ($item) {
                return !isset($item->phone) ? '' : new HotelPhone($item->phone);
            })
            ->forMember('email', function ($item) {
                return !isset($item->email) ? '' : new HotelEmail($item->email);
            })
            ->forMember('lift', function ($item) {
                return new HotelLift(!isset($item->lift) ? false : (bool)$item->lift);
            })
            ->forMember('wifi', function ($item) {
                return new HotelWifi(!isset($item->wifi) ? false : (bool)$item->wifi);
            })
            ->forMember('accessibility', function ($item) {
                return new HotelAccessibility(!isset($item->accessibility) ? false : (bool)$item->accessibility);
            })
            ->forMember('parking', function ($item) {
                return new HotelParking(!isset($item->parking) ? false : (bool)$item->parking);
            })
            ->forMember('kitchen', function ($item) {
                return new HotelKitchen(!isset($item->kitchen) ? false : (bool)$item->kitchen);
            })
            ->forMember('pets', function ($item) {
                return new HotelPets(!isset($item->pets) ? false : (bool)$item->pets);
            })
            ->forMember('paymentMethods', function ($item) {
                return new HotelPaymentMethods(!isset($item->payment_methods) ? [] : map(function ($paymentMethod) {
                    return $paymentMethod->name;
                }, $item->paymentMethods));
            })
            ->forMember('logo', function ($item) {
                return new HotelLogo(!isset($item->logo) ? null : $item->logo);
            })
            ->forMember('images', function ($item) {
                return new HotelImages(!isset($item->images) ? [] : map(function ($image) {
                    return $image->filename;
                }, $item->images));
            });

        return $config;
    }
}
