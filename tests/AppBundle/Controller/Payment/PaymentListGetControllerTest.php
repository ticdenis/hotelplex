<?php

declare(strict_types=1);

namespace App\Controller\Payment;

use HotelPlex\Domain\Repository\Payment\PaymentQueryRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class PaymentListGetControllerTest extends TestCase
{
    /**
     * @var MockObject
     */
    private $mockPaymentRepository;

    protected function setUp()
    {
        $this->mockPaymentRepository = $this->createMock(PaymentQueryRepository::class);
    }

    /**
     * @test
     */
    public function shouldReturnAPaymentListAndOKHTTPCode()
    {
        // Arrange
        $container = new Container();
        $this->mockPaymentRepository->method('all')->willReturn([]);
        $container->set('hotelplex.query-repository.payment', $this->mockPaymentRepository);
        $controller = new PaymentListGetController($container);
        // Action
        $response = $controller->__invoke(new Request());
        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }
}
