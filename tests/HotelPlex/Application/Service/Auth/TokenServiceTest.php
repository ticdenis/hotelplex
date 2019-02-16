<?php

declare(strict_types=1);

namespace HotelPlex\Tests\Application\Service\Auth;

use HotelPlex\Application\Presenter\Auth\TokenPresenter;
use HotelPlex\Application\Service\Auth\TokenRequest;
use HotelPlex\Application\Service\Auth\TokenService;
use HotelPlex\Domain\Entity\User\InvalidHotelArgumentException;
use HotelPlex\Domain\Exception\Auth\AuthException;
use HotelPlex\Domain\Factory\Auth\TokenFactory;
use HotelPlex\Domain\Repository\Provider\ProviderRepository;
use HotelPlex\Domain\Repository\User\UserRepository;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerProviderFactory;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerUserFactory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tasky\Domain\Model\User\ProviderInvalidEmailException;
use Tasky\Domain\Model\User\UserInvalidEmailException;

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
    private $fakeToken;
    /**
     * @var string
     */
    private $jwtPattern;

    /**
     * @throws InvalidHotelArgumentException
     * @throws ProviderInvalidEmailException
     * @throws UserInvalidEmailException
     */
    protected function setUp()
    {
        $this->mockUser = FakerUserFactory::create();
        $this->mockProvider = FakerProviderFactory::create();
        $this->mockUserRepository = $this->createMock(UserRepository::class);
        $this->mockProviderRepository = $this->createMock(ProviderRepository::class);
        $this->mockRequest = $this->createMock(TokenRequest::class);
        $this->presenter = new TokenPresenter();
        $this->mockTokenFactory = $this->createMock(TokenFactory::class);
        $this->fakeToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c";
        $this->jwtPattern = "/^[a-zA-Z0-9\-_]+?\.[a-zA-Z0-9\-_]+?\.([a-zA-Z0-9\-_]+)?$/";
    }

    /**
     * @test
     * @throws AuthException
     */
    public function shouldReturnATokenAsAUser()
    {
        // Arrange
        $this->mockUserRepository->method('ofEmailAndPassword')->willReturn($this->mockUser);
        $this->mockTokenFactory->method('build')->willReturn($this->fakeToken);
        $service = new TokenService($this->mockUserRepository, $this->mockTokenFactory);
        $this->mockRequest->method('email')->willReturn($this->mockUser->email()->value());
        $this->mockRequest->method('password')->willReturn($this->mockUser->password()->value());
        // Action
        $service->__invoke($this->mockRequest, $this->presenter);
        // Assert
        $this->assertRegExp($this->jwtPattern, $this->presenter->read());
    }

    /**
     * @test
     * @throws AuthException
     */
    public function shouldThrowAnAuthExceptionAsUserByInvalidEmail()
    {
        // Arrange
        $this->mockUserRepository->method('ofEmailAndPassword')->willThrowException(
            AuthException::withEmail('test@hotelplex.com')
        );
        $service = new TokenService($this->mockUserRepository, $this->mockTokenFactory);
        // Action
        $this->expectException(AuthException::class);
        // Assert
        $service->__invoke($this->mockRequest, $this->presenter);
    }

    /**
     * @test
     * @throws AuthException
     */
    public function shouldThrowAnAuthExceptionAsUserByInvalidRepository()
    {
        // Arrange
        $this->mockUserRepository->method('ofEmailAndPassword')->willThrowException(
            AuthException::invalidRepository('invalid-class-name')
        );
        // Assert
        $this->expectException(AuthException::class);
        // Action
        new TokenService(null, $this->mockTokenFactory);
    }

    /**
     * @test
     * @throws AuthException
     */
    public function shouldThrowAnAuthExceptionAsUserByNotFound()
    {
        // Arrange
        $service = new TokenService($this->mockUserRepository, $this->mockTokenFactory);
        // Assert
        $this->expectException(AuthException::class);
        // Action
        $service->__invoke($this->mockRequest, $this->presenter);
    }

    /**
     * @test
     * @throws AuthException
     */
    public function shouldReturnATokenAsAProvider()
    {
        // Arrange
        $this->mockProviderRepository->method('ofEmailAndPassword')->willReturn($this->mockProvider);
        $this->mockTokenFactory->method('build')->willReturn($this->fakeToken);
        $service = new TokenService($this->mockProviderRepository, $this->mockTokenFactory);
        $this->mockRequest->method('email')->willReturn($this->mockProvider->email()->value());
        $this->mockRequest->method('password')->willReturn($this->mockProvider->password()->value());
        // Action
        $service->__invoke($this->mockRequest, $this->presenter);
        // Assert
        $this->assertRegExp($this->jwtPattern, $this->presenter->read());
    }

    /**
     * @test
     * @throws AuthException
     */
    public function shouldThrowAnAuthExceptionAsProviderByInvalidEmail()
    {
        // Arrange
        $this->mockProviderRepository->method('ofEmailAndPassword')->willThrowException(
            AuthException::withEmail('test@hotelplex.com')
        );
        $service = new TokenService($this->mockProviderRepository, $this->mockTokenFactory);
        // Action
        $this->expectException(AuthException::class);
        // Assert
        $service->__invoke($this->mockRequest, $this->presenter);
    }

    /**
     * @test
     * @throws AuthException
     */
    public function shouldThrowAnAuthExceptionAsProviderByInvalidRepository()
    {
        // Arrange
        $this->mockProviderRepository->method('ofEmailAndPassword')->willThrowException(
            AuthException::invalidRepository('invalid-class-name')
        );
        // Assert
        $this->expectException(AuthException::class);
        // Action
        new TokenService(null, $this->mockTokenFactory);
    }

    /**
     * @test
     * @throws AuthException
     */
    public function shouldThrowAnAuthExceptionAsProviderByNotFound()
    {
        // Arrange
        $service = new TokenService($this->mockProviderRepository, $this->mockTokenFactory);
        // Assert
        $this->expectException(AuthException::class);
        // Action
        $service->__invoke($this->mockRequest, $this->presenter);
    }
}
