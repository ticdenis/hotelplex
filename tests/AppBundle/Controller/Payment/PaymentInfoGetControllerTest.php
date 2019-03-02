<?php

declare(strict_types=1);

namespace App\Controller\Payment;

use HotelPlex\Domain\Entity\Payment\Payment;
use HotelPlex\Domain\Repository\Payment\PaymentQueryRepository;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerPaymentFactory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class PaymentInfoGetControllerTest extends TestCase
{
    /**
     * @var MockObject
     */
    private $mockPaymentRepository;

    /**
     * @var Payment
     */
    private $mockPayment;

    protected function setUp()
    {
        $this->mockPaymentRepository = $this->createMock(PaymentQueryRepository::class);
        $this->mockPayment = FakerPaymentFactory::create();
    }

    /**
     * @test
     */
    public function shouldReturnAPaymentListAndOKHTTPCode()
    {
        // Arrange
        $container = new Container();
        $container->set('hotelplex.query-repository.payment', $this->mockPaymentRepository);
        $this->mockPaymentRepository->method('ofId')->willReturn($this->mockPayment);
        $controller = new PaymentInfoGetController($container);
        $request = new Request(['uuid' => $this->mockPayment->uuid()->value()]);
        // Action
        $response = $controller->__invoke($request);
        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }
}
