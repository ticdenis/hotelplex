<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service\Payment;

use HotelPlex\Application\Presenter\Payment\PaymentListPresenter;
use HotelPlex\Application\Service\EmptyRequest;
use HotelPlex\Application\Service\Service;
use HotelPlex\Domain\Repository\Payment\PaymentQueryRepository;

class PaymentListService implements Service
{
    /**
     * @var PaymentQueryRepository
     */
    private $repository;

    /**
     * @param PaymentQueryRepository $repository
     */
    public function __construct(PaymentQueryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param EmptyRequest $request
     * @param PaymentListPresenter $presenter
     * @return PaymentListPresenter
     */
    public function __invoke($request, $presenter): PaymentListPresenter
    {
        $hotels = $this->repository->all();

        return $presenter->write($hotels);
    }
}
