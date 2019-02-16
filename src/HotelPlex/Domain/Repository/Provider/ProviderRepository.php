<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Entity\Provider;

interface ProviderRepository
{
    /**
     * @param Provider $provider
     */
    public function create(Provider $provider): void;

}
