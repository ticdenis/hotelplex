<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Repository\User;

use HotelPlex\Domain\Entity\User\User;

interface UserCommandRepository
{
    /**
     * @param User $user
     */
    public function create(User $user): void;
}
