<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Repository\User;

use HotelPlex\Domain\Entity\User\User;

interface UserQueryRepository
{
    public function ofEmailAndPassword(string $email, string $password): ?User;
}
