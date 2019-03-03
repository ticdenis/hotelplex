<?php

declare(strict_types=1);

namespace App\Controller\Payment;

use HotelPlex\Domain\Entity\Payment\PaymentId;
use HotelPlex\Domain\Repository\Payment\PaymentQueryRepository;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerPaymentFactory;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

final class PaymentInfoGetControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    private $client;

    protected function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * @test
     */
    public function shouldReturnAPaymentInfoGivenAnUuidAndOKHTTPCode()
    {
        // Arrange
        $payments = [FakerPaymentFactory::create()];
        $mockRepository = $this->createMock(PaymentQueryRepository::class);
        $mockRepository->method('all')->willReturn($payments);
        $mockRepository->method('ofId')->willReturn($payments[0]);
        $this->client->getContainer()->set('hotelplex.query-repository.payment', $mockRepository);
        // Action
        $this->client->request('GET', sprintf('/payments/%s', $payments[0]->uuid()->value()));
        // Assert
        $this->customAssert(JsonResponse::HTTP_OK);
    }

    /**
     * @test
     */
    public function shouldNotReturnAPaymentInfoGivenAnUuidThatNotExistsAndNotFoundHTTPCode()
    {
        // Arrange
        $paymentId = new PaymentId();
        // Action
        $this->client->request('GET', sprintf('/payments/%s', $paymentId->value()));
        // Assert
        $this->customAssert(JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * @param int $httpStatusCode
     */
    private function customAssert(int $httpStatusCode): void
    {
        $this->assertEquals($httpStatusCode, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());
    }
}
