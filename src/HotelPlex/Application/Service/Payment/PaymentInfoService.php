<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service\Payment;

use HotelPlex\Application\Presenter\Payment\PaymentPresenter;
use HotelPlex\Application\Service\Service;
use HotelPlex\Domain\Exception\Payment\PaymentNotFoundException;
use HotelPlex\Domain\Repository\Payment\PaymentQueryRepository;

class PaymentInfoService implements Service
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
     * @param PaymentInfoRequest $request
     * @param PaymentPresenter $presenter
     * @return PaymentPresenter
     * @throws PaymentNotFoundException
     */
    public function __invoke($request, $presenter): PaymentPresenter
    {
        $payment = $this->repository->ofId($request->uuid());

        if ($payment === null) {
            throw PaymentNotFoundException::withUUID($request->uuid()->value());
        }

        return $presenter->write($payment);
    }
}
