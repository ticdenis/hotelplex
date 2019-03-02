<?php

declare(strict_types=1);

namespace App\GraphQL\Payment;

use HotelPlex\Domain\Repository\Payment\PaymentQueryRepository;
use Overblog\GraphQLBundle\Definition\Argument;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;

class PaymentListResolverTest extends TestCase
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
    public function shouldReturnAListOfPayments()
    {
        // Arrange
        $container = new Container();
        $this->mockPaymentRepository->method('all')->willReturn([]);
        $container->set('hotelplex.query-repository.payment', $this->mockPaymentRepository);
        $resolver = new PaymentListResolver($container);
        // Action
        $response = $resolver->resolve(new Argument());
        // Assert
        $this->assertEmpty($response);
    }
}
