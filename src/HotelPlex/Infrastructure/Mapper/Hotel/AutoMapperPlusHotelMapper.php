<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Mapper\Hotel;

use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use HotelPlex\Application\Mapper\Hotel\HotelMapper;
use HotelPlex\Domain\Entity\Hotel\Hotel;
use HotelPlex\Domain\ValueObject\DateTimeValueObject;
use HotelPlex\Domain\ValueObject\UuidValueObject;
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
                return new UuidValueObject($item->uuid);
            })
            ->forMember('name', function ($item) {
                return !isset($item->name) ? '' : $item->name;
            })
            ->forMember('address', function ($item) {
                return !isset($item->address) ? '' : $item->address;
            })
            ->forMember('phone', function ($item) {
                return !isset($item->phone) ? '' : $item->phone;
            })
            ->forMember('email', function ($item) {
                return !isset($item->email) ? '' : $item->email;
            })
            ->forMember('lift', function ($item) {
                return !isset($item->lift) ? false : (bool)$item->lift;
            })
            ->forMember('wifi', function ($item) {
                return !isset($item->wifi) ? false : (bool)$item->wifi;
            })
            ->forMember('accessibility', function ($item) {
                return !isset($item->accessibility) ? false : (bool)$item->accessibility;
            })
            ->forMember('parking', function ($item) {
                return !isset($item->parking) ? false : (bool)$item->parking;
            })
            ->forMember('kitchen', function ($item) {
                return !isset($item->kitchen) ? false : (bool)$item->kitchen;
            })
            ->forMember('pets', function ($item) {
                return !isset($item->pets) ? false : (bool)$item->pets;
            })
            ->forMember('paymentMethods', function ($item) {
                return !isset($item->payment_methods) ? [] : map(function ($paymentMethod) {
                    return $paymentMethod->name;
                }, $item->paymentMethods);
            })
            ->forMember('logo', function ($item) {
                return !isset($item->logo) ? null : $item->logo;
            })
            ->forMember('images', function ($item) {
                return !isset($item->images) ? [] : map(function ($image) {
                    return $image->filename;
                }, $item->images);
            })
            ->forMember('createdAt', function ($item) {
                if (!isset($item->created_at)) {
                    return DateTimeValueObject::now();
                } else if (($timestamp = (int)$item->created_at) !== 0) {
                    return DateTimeValueObject::fromInt($timestamp);
                } else {
                    return DateTimeValueObject::fromString($item->created_at);
                }
            })
            ->forMember('updatedAt', function ($item) {
                if (!isset($item->updated_at)) {
                    return DateTimeValueObject::now();
                } else if (($timestamp = (int)$item->updated_at) !== 0) {
                    return DateTimeValueObject::fromInt($timestamp);
                } else {
                    return DateTimeValueObject::fromString($item->updated_at);
                }
            });

        return $config;
    }
}
