<?php

declare(strict_types=1);

namespace App\Tests\GraphQL\Payment;

use App\GraphQL\Payment\PaymentInfoResolver;
use HotelPlex\Domain\Entity\Payment\Payment;
use HotelPlex\Domain\Repository\Payment\PaymentQueryRepository;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerPaymentFactory;
use Overblog\GraphQLBundle\Definition\Argument;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;

final class PaymentInfoResolverTest extends TestCase
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
    public function shouldReturnAPayment()
    {
        // Arrange
        $container = new Container();
        $container->set('hotelplex.query-repository.payment', $this->mockPaymentRepository);
        $this->mockPaymentRepository->method('ofId')->willReturn($this->mockPayment);
        $resolver = new PaymentInfoResolver($container);
        // Action
        $response = $resolver->resolve(
            new Argument(['uuid' => $this->mockPayment->uuid()->value()])
        );
        // Assert
        $this->assertNotEmpty($response);
    }

}
