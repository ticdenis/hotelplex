<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service\Hotel;

use HotelPlex\Application\Presenter\Hotel\HotelPresenter;
use HotelPlex\Application\Service\EmptyRequest;
use HotelPlex\Application\Service\Service;
use HotelPlex\Domain\Exception\Hotel\HotelNotFoundException;
use HotelPlex\Domain\Repository\Hotel\HotelRepository;

class HotelService implements Service
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
     * @param HotelRequest $request
     * @param HotelPresenter $presenter
     * @return HotelPresenter
     * @throws HotelNotFoundException
     */
    public function __invoke($request, $presenter): HotelPresenter
    {
        $hotel = $this->repository->ofIdOrFail($request->uuid());

        return $presenter->write($hotel);
    }
}
