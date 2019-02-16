<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Factory\Provider;

use HotelPlex\Domain\Entity\Provider\Provider;

interface ProviderFactory
{
    /**
     * @param array $source Constructor params.
     * @return Provider
     */
    public function build(array $source): Provider;
}
