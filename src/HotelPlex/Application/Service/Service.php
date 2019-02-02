<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service;

use HotelPlex\Application\Presenter\Presenter;

interface Service
{
    /**
     * @param Request $request
     * @param Presenter $presenter
     * @return mixed
     */
    public function execute($request, $presenter);
}
