<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Repository\User;

interface UserRepository
{
    public function ofEmailAndPassword(string $email, string $password): ?User;
}
