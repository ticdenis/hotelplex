<?php

declare(strict_types=1);

namespace HotelPlex\Application\Mapper\User;

use HotelPlex\Application\Mapper\Mapper;
use HotelPlex\Application\Mapper\MapperSanitizeTrait;
use HotelPlex\Domain\Entity\User\User;

abstract class UserMapper implements Mapper
{
    use MapperSanitizeTrait;

    /**
     * @return string
     */
    final public function entity(): string
    {
        return User::class;
    }

    /**
     * @param $source
     * @return User
     */
    abstract function item($source);

    /**
     * @param array $sources
     * @return User[]
     */
    abstract function items(array $sources);
}
