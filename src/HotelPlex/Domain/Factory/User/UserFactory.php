<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Factory\User;

use HotelPlex\Domain\Entity\User\User;

interface UserFactory
{
    /**
     * @param array $source Constructor params.
     * @return User
     */
    public function build(array $source): User;
}
