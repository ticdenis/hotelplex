<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Repository\Provider;

use HotelPlex\Domain\Entity\Provider\Provider;

interface ProviderQueryRepository
{
    /**
     * @param string $email
     * @param string $password
     * @return Provider|null
     */
    public function ofEmailAndPassword(string $email, string $password): ?Provider;

}
