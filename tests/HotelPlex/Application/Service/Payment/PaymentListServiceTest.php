<?php

declare(strict_types=1);

namespace HotelPlex\Tests\Application\Service\Payment;

use HotelPlex\Application\Service\EmptyRequest;
use HotelPlex\Application\Service\Payment\PaymentListService;
use HotelPlex\Domain\Entity\Payment\Payment;
use HotelPlex\Domain\Repository\Payment\PaymentQueryRepository;
use HotelPlex\Infrastructure\Presenter\Payment\ArrayPaymentListPresenter;
use HotelPlex\Infrastructure\Presenter\Payment\ArrayPaymentPresenter;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerPaymentFactory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class PaymentListServiceTest extends TestCase
{
    /**
     * @var Payment[]
     */
    private $payments;

    /**
     * @var MockObject
     */
    private $paymentRepository;

    protected function setUp()
    {
        $this->paymentRepository = $this->createMock(PaymentQueryRepository::class);
        $this->payments = [
            FakerPaymentFactory::create(),
            FakerPaymentFactory::create()
        ];
    }

    /**
     * @test
     */
    public function shouldRegisterProvider()
    {
        // Arrange
        $service = new PaymentListService($this->paymentRepository);
        $this->paymentRepository->method('all')->willReturn($this->payments);
        // Action
        $presenter = $service->__invoke(
            new EmptyRequest(),
            new ArrayPaymentListPresenter(new ArrayPaymentPresenter())
        );
        $result = $presenter->read();
        // Assert
        $this->assertCount(count($this->payments), $result);
    }
}
