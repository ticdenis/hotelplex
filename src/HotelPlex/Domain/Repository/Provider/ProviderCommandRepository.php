<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Repository\Provider;

use HotelPlex\Domain\Entity\Provider\Provider;

interface ProviderCommandRepository
{
    /**
     * @param Provider $provider
     */
    public function create(Provider $provider): void;
}
