<?php

declare(strict_types=1);

namespace App\Tests\GraphQL\Payment;

use App\Tests\GraphQL\GraphQLTestCase;
use HotelPlex\Domain\Repository\Payment\PaymentQueryRepository;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerPaymentFactory;

final class PaymentInfoResolverTest extends GraphQLTestCase
{
    private const CUSTOM_QUERY = <<<'GRAPHQL'
            query _($uuid: String!) {
               paymentInfo(uuid: $uuid) {
                   uuid
                   method
                   currency
                   price
                   createdAt
               }
            }
GRAPHQL;

    /**
     * @test
     */
    public function shouldReturnAPayment()
    {
        // Arrange
        $payment = FakerPaymentFactory::create();
        $mockRepository = $this->createMock(PaymentQueryRepository::class);
        $mockRepository->method('all')->willReturn([$payment]);
        $mockRepository->method('ofId')->willReturn($payment);
        $this->client->getContainer()->set('hotelplex.query-repository.payment', $mockRepository);
        $query = self::CUSTOM_QUERY;
        $variables = [
            'uuid' => $payment->uuid()->value()
        ];
        // Action
        $this->queryRequest($query, $variables);
        // Assert
        $this->graphqlAssert();
        $this->assertArraySubset([
            'uuid' => $payment->uuid()->value(),
            'method' => $payment->paymentMethod()->value(),
            'currency' => $payment->amount()->currency(),
            'price' => $payment->amount()->price(),
            'createdAt' => $payment->createdAt()->toUSFormat(),
        ], $this->decodeJsonResponseAsArray()['paymentInfo']);
    }
}
