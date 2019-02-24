<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Mapper\User;

use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use HotelPlex\Application\Mapper\User\UserMapper;
use HotelPlex\Domain\Entity\User\User;
use HotelPlex\Domain\Entity\User\UserEmail;
use HotelPlex\Domain\Entity\User\UserPassword;
use HotelPlex\Domain\Entity\User\UserUsername;
use HotelPlex\Domain\ValueObject\UuidValueObject;
use stdClass;
use function Lambdish\Phunctional\map;

class AutoMapperPlusUserMapper extends UserMapper
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
     * @return User
     */
    public function item($source)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return $this->mapper->map($this->sanitize($source), $this->entity());
    }

    /** @noinspection PhpDocMissingThrowsInspection */
    /**
     * @param array $sources
     * @return User[]
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
            ->forMember('username', function ($item) {
                return new UserUsername(!isset($item->username) ? '' : $item->username);
            })
            ->forMember('email', function ($item) {
                return !isset($item->email) ? new UserEmail('test@hotelplex.com') : new UserEmail($item->email);
            })
            ->forMember('password', function ($item) {
                return !isset($item->password) ? new UserPassword('test') : new UserPassword($item->password);
            })
            ->forMember('hotels', function ($item) {
                return !isset($item->hotels) || !is_array($item->hotels) ? [] : map(function ($hotel) {
                    return $hotel->uuid;
                }, $item->hotels);
            });

        return $config;
    }
}
