<?php

declare(strict_types=1);

namespace HotelPlex\Tests\Application\Service\Payment;

use HotelPlex\Application\Service\Payment\PaymentInfoRequest;
use HotelPlex\Application\Service\Payment\PaymentInfoService;
use HotelPlex\Domain\Entity\Payment\Payment;
use HotelPlex\Domain\Exception\Payment\PaymentNotFoundException;
use HotelPlex\Domain\Repository\Payment\PaymentQueryRepository;
use HotelPlex\Infrastructure\Presenter\Payment\ArrayPaymentPresenter;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerPaymentFactory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class PaymentInfoServiceTest extends TestCase
{
    /**
     * @var Payment
     */
    private $payment;

    /**
     * @var MockObject
     */
    private $paymentRepository;

    /**
     * @var PaymentInfoRequest
     */
    private $request;

    /**
     * @var PaymentInfoService
     */
    private $service;

    /**
     * @var ArrayPaymentPresenter
     */
    private $presenter;

    protected function setUp()
    {
        $this->paymentRepository = $this->createMock(PaymentQueryRepository::class);
        $this->payment = FakerPaymentFactory::create();
        $this->request = new PaymentInfoRequest($this->payment->uuid()->value());
        $this->service = new PaymentInfoService($this->paymentRepository);
        $this->presenter = new ArrayPaymentPresenter();
    }



    /**
     * @test
     * @throws PaymentNotFoundException
     */
    public function shouldThrowAPaymentNotFoundException()
    {
        // Arrange
        $this->paymentRepository->method('ofId')->willReturn($this->payment);
        // Action
        $presenter = $this->service->__invoke(
            $this->request,
            $this->presenter
        );
        $result = $presenter->read();
        // Assert
        $this->assertEquals($this->payment->uuid()->value(), $result['uuid']);
    }

    /**
     * @test
     * @throws PaymentNotFoundException
     */
    public function shouldGetReturnPaymentInfo()
    {
        // Arrange
        $this->paymentRepository->method('ofId')->willThrowException(
            PaymentNotFoundException::withUUID($this->payment->uuid()->value())
        );
        // Assert
        $this->expectException(PaymentNotFoundException::class);
        // Action
        $this->service->__invoke(
            $this->request,
            $this->presenter
        );
    }
}
