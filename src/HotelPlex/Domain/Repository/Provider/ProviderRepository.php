<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Repository\Provider;

use HotelPlex\Domain\Entity\Provider\Provider;

interface ProviderRepository
{
    public function ofEmailAndPassword(string $email, string $password): ?Provider;
namespace HotelPlex\Domain\Entity\Provider;

interface ProviderRepository
{
    /**
     * @param Provider $provider
     */
    public function create(Provider $provider): void;

}
