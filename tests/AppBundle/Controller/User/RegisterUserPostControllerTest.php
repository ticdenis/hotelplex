<?php

declare(strict_types=1);

namespace App\Tests\Controller\User;

use App\Controller\User\RegisterUserPostController;
use HotelPlex\Domain\Entity\User\User;
use HotelPlex\Domain\Entity\User\UserHotelsException;
use HotelPlex\Domain\Exception\User\UserInvalidEmailException;
use HotelPlex\Domain\Repository\User\UserCommandRepository;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerUserFactory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class RegisterUserPostControllerTest extends TestCase
{
    /**
     * @var User
     */
    private $mockUser;
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
        $this->mockUser = FakerUserFactory::create();
        $this->mockUserRepository = $this->createMock(UserCommandRepository::class);
    }

    /**
     * @test
     */
    public function shouldRegisterAUserAndReturnAndEmptyResponseWithHttpCreatedStatusCode()
    {
        // Arrange
        $container = new Container();
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
