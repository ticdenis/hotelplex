<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Repository\Provider;

interface ProviderRepository
{
    public function ofEmailAndPassword(string $email, string $password): ?Provider;
}
