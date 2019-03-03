<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Mapper\User;

use AutoMapperPlus\Configuration\AutoMapperConfig;
use HotelPlex\Application\Mapper\User\UserMapper;
use HotelPlex\Domain\Entity\User\UserEmail;
use HotelPlex\Domain\Entity\User\UserPassword;
use HotelPlex\Domain\Entity\User\UserUsername;
use HotelPlex\Domain\ValueObject\UuidValueObject;
use HotelPlex\Infrastructure\Mapper\AutoMapperPlusTrait;
use stdClass;
use function Lambdish\Phunctional\map;

class AutoMapperPlusUserMapper extends UserMapper
{
    use AutoMapperPlusTrait;

    /**
     * @return AutoMapperConfig
     */
    protected function config(): AutoMapperConfig
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
