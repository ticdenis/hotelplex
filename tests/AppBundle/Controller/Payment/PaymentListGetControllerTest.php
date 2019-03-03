<?php

declare(strict_types=1);

namespace App\Controller\Payment;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

final class PaymentListGetControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function shouldReturnAPaymentListAndOKHTTPCode()
    {
        // Arrange
        $client = static::createClient();
        // Action
        $client->request('GET', '/payments');
        // Assert
        $this->assertEquals(JsonResponse::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }
}
