<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service\Hotel;

use HotelPlex\Application\Presenter\Hotel\HotelListPresenter;
use HotelPlex\Application\Service\EmptyRequest;
use HotelPlex\Application\Service\Service;
use HotelPlex\Domain\Repository\Hotel\HotelQueryRepository;

class HotelListService implements Service
{
    /**
     * @var HotelQueryRepository
     */
    private $repository;

    /**
     * @param HotelQueryRepository $repository
     */
    public function __construct(HotelQueryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param EmptyRequest $request
     * @param HotelListPresenter $presenter
     * @return HotelListPresenter
     */
    public function __invoke($request, $presenter): HotelListPresenter
    {
        $hotels = $this->repository->all();

        return $presenter->write($hotels);
    }
}
