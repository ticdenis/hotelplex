<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Factory\Auth;

interface TokenFactory
{
    /**
     * @param User|Provider $userOrProvider
     * @return string
     */
    public function build($userOrProvider): string;
}
