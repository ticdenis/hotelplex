<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Mapper;

use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use HotelPlex\Application\Exception\Mapper\InvalidSourceArgumentToSanitizeException;
use stdClass;

trait AutoMapperPlusTrait
{
    /**
     * @var AutoMapper
     */
    protected $mapper;

    public function __construct()
    {
        $this->mapper = new AutoMapper($this->config());
    }

    /** @noinspection PhpDocMissingThrowsInspection */
    /**
     * @param $source
     * @return stdClass
     */
    public function item($source)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return $this->mapper->map($this->sanitize($source), $this->entity());
    }

    /** @noinspection PhpDocMissingThrowsInspection */
    /**
     * @param array $sources
     * @return array
     */
    public function items(array $sources)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return $this->mapper->mapMultiple($this->sanitize($sources), $this->entity());
    }

    /**
     * @param mixed $source
     * @return object|object[]
     * @throws InvalidSourceArgumentToSanitizeException
     */
    protected abstract function sanitize($source);

    /**
     * @return AutoMapperConfig
     */
    protected abstract function config(): AutoMapperConfig;
}
