<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Mapper\Provider;

use AutoMapperPlus\Configuration\AutoMapperConfig;
use HotelPlex\Application\Mapper\Provider\ProviderMapper;
use HotelPlex\Domain\Entity\Provider\ProviderEmail;
use HotelPlex\Domain\Entity\Provider\ProviderId;
use HotelPlex\Domain\Entity\Provider\ProviderPassword;
use HotelPlex\Infrastructure\Mapper\AutoMapperPlusTrait;
use stdClass;

class AutoMapperPlusProviderMapper extends ProviderMapper
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
                return new ProviderId($item->uuid);
            })
            ->forMember('username', function ($item) {
                return !isset($item->username) ? '' : $item->username;
            })
            ->forMember('email', function ($item) {
                return !isset($item->email) ? new ProviderEmail('test@hotelplex.com') : new ProviderEmail($item->email);
            })
            ->forMember('password', function ($item) {
                return !isset($item->password) ? new ProviderPassword('test') : new ProviderPassword($item->password);
            });

        return $config;
    }
}
