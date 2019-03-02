<?php

declare(strict_types=1);

namespace App\Tests\Controller\User;

use App\Controller\User\RegisterUserPostController;
use HotelPlex\Domain\Entity\Hotel\Hotel;
use HotelPlex\Domain\Entity\User\User;
use HotelPlex\Domain\Entity\User\UserHotelsException;
use HotelPlex\Domain\Exception\User\UserInvalidEmailException;
use HotelPlex\Domain\Repository\Hotel\HotelQueryRepository;
use HotelPlex\Domain\Repository\User\UserCommandRepository;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerHotelFactory;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerUserFactory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class RegisterUserPostControllerTest extends TestCase
{
    /**
     * @var Hotel
     */
    private $mockHotel;
    /**
     * @var User
     */
    private $mockUser;
    /**
     * @var MockObject
     */
    private $mockHotelRepository;
    /**
     * @var MockObject
     */
    private $mockUserRepository;

    /**
     * @throws UserHotelsException
     * @throws UserInvalidEmailException
     */
    protected function setUp()
    {
        $this->mockHotel = FakerHotelFactory::create();
        $this->mockUser = FakerUserFactory::create();
        $this->mockHotelRepository = $this->createMock(HotelQueryRepository::class);
        $this->mockUserRepository = $this->createMock(UserCommandRepository::class);
    }

    /**
     * @test
     *
     * @throws UserHotelsException
     * @throws UserInvalidEmailException
     */
    public function shouldRegisterAUserAndReturnAndEmptyResponseWithHttpCreatedStatusCode()
    {
        // Arrange
        $container = new Container();
        $this->mockHotelRepository->method('ofId')->willReturn($this->mockHotel);
        $container->set('hotelplex.query-repository.hotel', $this->mockHotelRepository);
        $container->set('hotelplex.command-repository.user', $this->mockUserRepository);
        $controller = new RegisterUserPostController($container);
        $request = new Request(
            [],
            [
                'uuid' => $this->mockUser->uuid()->value(),
                'username' => $this->mockUser->username()->value(),
                'email' => $this->mockUser->email()->value(),
                'password' => $this->mockUser->password()->value(),
                'hotels' => $this->mockUser->hotels()->value()
            ]
        );
        // Action
        $response = $controller->__invoke($request);
        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(JsonResponse::HTTP_CREATED, $response->getStatusCode());
        $this->assertJson('{}', $response->getContent());
    }

}
