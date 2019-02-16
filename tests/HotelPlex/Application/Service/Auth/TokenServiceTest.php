<?php

declare(strict_types=1);

namespace HotelPlex\Tests\Application\Service\Auth;

use HotelPlex\Application\Presenter\TokenPresenter;
use HotelPlex\Application\Service\Auth\TokenRequest;
use HotelPlex\Application\Service\Auth\TokenService;
use HotelPlex\Domain\Factory\Auth\TokenFactory;
use HotelPlex\Domain\Repository\Provider\ProviderRepository;
use HotelPlex\Domain\Repository\User\UserRepository;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerProviderFactory;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerUserFactory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class TokenServiceTest extends TestCase
{
    /**
     * @var MockObject
     */
    private $mockUser;
    /**
     * @var MockObject
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
    private $mockService;
    /**
     * @var MockObject
     */
    private $mockRequest;
    /**
     * @var MockObject
     */
    private $mockTokenFactory;
    /**
     * @var TokenPresenter
     */
    private $presenter;
    /**
     * @var string
     */
    private $jwtPattern;

    protected function setUp()
    {
        $this->mockUser = FakerUserFactory::create();
        $this->mockProvider = FakerProviderFactory::create();
        $this->mockUserRepository = $this->createMock(UserRepository::class);
        $this->mockProviderRepository = $this->createMock(ProviderRepository::class);
        $this->mockService = $this->createMock(TokenService::class);
        $this->mockRequest = $this->createMock(TokenRequest::class);
        $this->presenter = new TokenPresenter();
        $this->mockTokenFactory = $this->createMock(TokenFactory::class);
        $this->jwtPattern = "^[a-zA-Z0-9\-_]+?\.[a-zA-Z0-9\-_]+?\.([a-zA-Z0-9\-_]+)?$";
    }

    /**
     * @test
     * @throws
     */
    public function shouldReturnATokenAsAUser()
    {
        // Arrange
        $this->mockUserRepository->method('ofEmailAndPasswordOrFail')->willReturn($this->mockUser);
        $service = new TokenService($this->mockUserRepository, $this->mockTokenFactory);
        $this->mockRequest->method('email')->willReturn($this->mockUser->email()->value());
        $this->mockRequest->method('password')->willReturn($this->mockUser->password()->value());
        // Action
        $token = $service->execute($this->mockRequest, $this->presenter);
        // Assert
        $this->assertRegExp($this->jwtPattern, $token);
    }
}
