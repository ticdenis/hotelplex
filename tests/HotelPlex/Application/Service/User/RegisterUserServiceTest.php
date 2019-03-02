<?php

declare(strict_types=1);

namespace HotelPlex\Tests\Application\Service\User;

use HotelPlex\Application\Presenter\EmptyPresenter;
use HotelPlex\Application\Service\User\RegisterUserRequest;
use HotelPlex\Application\Service\User\RegisterUserService;
use HotelPlex\Domain\Entity\User\User;
use HotelPlex\Domain\Entity\User\UserHotelsException;
use HotelPlex\Domain\Exception\User\UserInvalidEmailException;
use HotelPlex\Domain\Repository\User\UserCommandRepository;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerUserFactory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class RegisterUserServiceTest extends TestCase
{
    /**
     * @var User
     */
    private $mockUser;
    /**
     * @var RegisterUserRequest
     */
    private $request;
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
        $this->request = new RegisterUserRequest(
            $this->mockUser->uuid()->value(),
            $this->mockUser->username()->value(),
            $this->mockUser->email()->value(),
            $this->mockUser->password()->value(),
            $this->mockUser->hotels()->value()
        );
        $this->mockUserRepository = $this->createMock(UserCommandRepository::class);
    }

    /**
     * @test
     */
    public function shouldRegisterUser()
    {
        // Arrange
        $mockUser = $this->mockUser;
        // Assert
        $this->mockUserRepository->expects($this->once())
            ->method('create')
            ->with($this->callback(function (User $user) use ($mockUser) {
                return
                    $user->uuid()->equalsTo($mockUser->uuid()) &&
                    $user->username()->equalsTo($mockUser->username()) &&
                    $user->email()->equalsTo($mockUser->email()) &&
                    $user->hotels()->equalsTo($mockUser->hotels());
            }));
        // Action
        $service = new RegisterUserService($this->mockUserRepository);
        $service->__invoke($this->request, new EmptyPresenter());
    }
}
