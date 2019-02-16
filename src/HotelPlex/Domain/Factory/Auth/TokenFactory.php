<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Factory\Auth;

use HotelPlex\Domain\Entity\Provider\Provider;
use HotelPlex\Domain\Entity\User\User;

interface TokenFactory
{
    /**
     * @param User|Provider $userOrProvider
     * @return string
     */
    public function build($userOrProvider): string;
}
