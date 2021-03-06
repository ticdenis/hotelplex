<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service\Hotel;

use HotelPlex\Application\Presenter\Hotel\HotelPresenter;
use HotelPlex\Application\Service\Service;
use HotelPlex\Domain\Exception\Hotel\HotelNotFoundException;
use HotelPlex\Domain\Repository\Hotel\HotelQueryRepository;

class HotelService implements Service
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
     * @param HotelRequest $request
     * @param HotelPresenter $presenter
     * @return HotelPresenter
     * @throws HotelNotFoundException
     */
    public function __invoke($request, $presenter): HotelPresenter
    {
        $hotel = $this->repository->ofId($request->uuid());

        if ($hotel === null) {
            throw HotelNotFoundException::withUUID($request->uuid()->value());
        }

        return $presenter->write($hotel);
    }
}
