<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service\Hotel;

use HotelPlex\Application\Presenter\Hotel\HotelListPresenter;
use HotelPlex\Application\Service\EmptyRequest;
use HotelPlex\Application\Service\Service;
use HotelPlex\Domain\Repository\Hotel\HotelRepository;

class HotelListService implements Service
{
    /**
     * @var HotelRepository
     */
    private $repository;

    /**
     * @param HotelRepository $repository
     */
    public function __construct(HotelRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param EmptyRequest $request
     * @param HotelListPresenter $presenter
     * @return HotelListPresenter
     */
    public function execute($request, $presenter): HotelListPresenter
    {
        $hotels = $this->repository->all();

        return $presenter->write($hotels);
    }
}
