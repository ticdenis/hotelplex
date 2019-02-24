<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use HotelPlex\Domain\Entity\Provider\Provider;
use HotelPlex\Domain\Entity\User\User;
use HotelPlex\Domain\Entity\User\UserHotelsException;
use HotelPlex\Domain\Factory\Auth\TokenFactory;
use HotelPlex\Domain\Repository\Provider\ProviderQueryRepository;
use HotelPlex\Domain\Repository\User\UserQueryRepository;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerProviderFactory;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerUserFactory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Tasky\Domain\Model\Provider\ProviderInvalidEmailException;
use Tasky\Domain\Model\User\UserInvalidEmailException;

final class TokenPostControllerTest extends TestCase
{
    /**
     * @var User
     */
    private $mockUser;
    /**
     * @var Provider
     */
    private $mockProvider;
    /**
     * @var MockObject
     */
    private $mockUserRepository;
    /**
     * @var MockObject
     */
    private $mockProviderRepository;
    /**
     * @var MockObject
     */
    private $mockTokenFactory;

    /**
     * @throws UserHotelsException
     * @throws ProviderInvalidEmailException
     * @throws UserInvalidEmailException
     */
    protected function setUp()
    {
        $this->mockUser = FakerUserFactory::create();
        $this->mockProvider = FakerProviderFactory::create();
        $this->mockUserRepository = $this->createMock(UserQueryRepository::class);
        $this->mockProviderRepository = $this->createMock(ProviderQueryRepository::class);
        $this->mockTokenFactory = $this->createMock(TokenFactory::class);
    }

    /**
     * @test
     */
    public function shouldReturnATokenAndCreatedHTTPCodeAsAUser()
    {
        // Arrange
        $container = new Container();
        $this->mockUserRepository->method('ofEmailAndPassword')->willReturn($this->mockUser);
        $container->set('hotelplex.repository.user', $this->mockUserRepository);
        $container->set('hotelplex.repository.provider', $this->mockProviderRepository);
        $controller = new TokenPostController($container);
        $request = new Request([], [
            'email' => $this->mockUser->email()->value(),
            'password' => $this->mockUser->password()->value()
        ]);
        // Action
        $response = $controller->__invoke($request);
        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(JsonResponse::HTTP_CREATED, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }

    /**
     * @test
     */
    public function shouldReturnATokenAndCreatedHTTPCodeAsAProvider()
    {
        // Arrange
        $container = new Container();
        $container->set('hotelplex.repository.user', $this->mockUserRepository);
        $this->mockProviderRepository->method('ofEmailAndPassword')->willReturn($this->mockProvider);
        $container->set('hotelplex.repository.provider', $this->mockProviderRepository);
        $controller = new TokenPostController($container);
        $request = new Request([], [
            'email' => $this->mockProvider->email()->value(),
            'password' => $this->mockProvider->password()->value()
        ]);
        // Action
        $response = $controller->__invoke($request);
        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(JsonResponse::HTTP_CREATED, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }

    /**
     * @test
     */
    public function shouldReturnAnErrorAndUnauthorizedHTTPCode()
    {
        // Arrange
        $container = new Container();
        $container->set('hotelplex.repository.user', $this->mockUserRepository);
        $container->set('hotelplex.repository.provider', $this->mockProviderRepository);
        $controller = new TokenPostController($container);
        $request = new Request([], [
            'email' => 'test@hotelplex.com',
            'password' => 'secret'
        ]);
        // Action
        $response = $controller->__invoke($request);
        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(JsonResponse::HTTP_UNAUTHORIZED, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }
}
