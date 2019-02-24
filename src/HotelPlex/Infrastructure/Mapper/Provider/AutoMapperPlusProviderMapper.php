<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Mapper\Provider;

use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use HotelPlex\Application\Mapper\Provider\ProviderMapper;
use HotelPlex\Domain\Entity\Provider\Provider;
use HotelPlex\Domain\Entity\Provider\ProviderEmail;
use HotelPlex\Domain\Entity\Provider\ProviderId;
use HotelPlex\Domain\Entity\Provider\ProviderPassword;
use HotelPlex\Domain\ValueObject\DateTimeValueObject;
use stdClass;

class AutoMapperPlusProviderMapper extends ProviderMapper
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
     * @return Provider
     */
    public function item($source)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return $this->mapper->map($this->sanitize($source), $this->entity());
    }

    /** @noinspection PhpDocMissingThrowsInspection */
    /**
     * @param array $sources
     * @return Provider[]
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
