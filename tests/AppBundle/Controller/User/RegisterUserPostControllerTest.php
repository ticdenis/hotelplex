<?php

declare(strict_types=1);

namespace App\Tests\Controller\User;

use HotelPlex\Domain\Entity\User\UserHotelsException;
use HotelPlex\Domain\Exception\User\UserInvalidEmailException;
use HotelPlex\Domain\Repository\Hotel\HotelQueryRepository;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerHotelFactory;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerUserFactory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

final class RegisterUserPostControllerTest extends WebTestCase
{
    /**
     * @test
     *
     * @throws UserHotelsException
     * @throws UserInvalidEmailException
     */
    public function shouldRegisterAUserAndReturnAndEmptyResponseWithHttpCreatedStatusCode()
    {
        // Arrange
        $client = static::createClient();
        $mockHotel = FakerHotelFactory::create();
        $mockHotelRepository = $this->createMock(HotelQueryRepository::class);
        $mockHotelRepository->method('ofId')->willReturn($mockHotel);
        $client->getContainer()->set('hotelplex.query-repository.hotel', $mockHotelRepository);
        $mockUser = FakerUserFactory::create();
        $data = [
            'uuid' => $mockUser->uuid()->value(),
            'username' => $mockUser->username()->value(),
            'email' => 'register-user-post-controller-test@hotelplex.com',
            'password' => $mockUser->password()->value(),
            'hotels' => [$mockHotel->uuid()->value()]
        ];
        // Action
        $client->request('POST', '/users', $data);
        // Assert
        $this->assertEquals(JsonResponse::HTTP_CREATED, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }

}
