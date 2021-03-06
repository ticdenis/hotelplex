<?php

declare(strict_types=1);

namespace App\Tests\GraphQL\User;

use App\GraphQL\User\RegisterUserResolver;
use HotelPlex\Domain\Entity\User\User;
use HotelPlex\Domain\Entity\User\UserHotelsException;
use HotelPlex\Domain\Exception\User\UserInvalidEmailException;
use HotelPlex\Domain\Repository\Hotel\HotelQueryRepository;
use HotelPlex\Domain\Repository\User\UserCommandRepository;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerHotelFactory;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerUserFactory;
use Overblog\GraphQLBundle\Definition\Argument;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;

final class RegisterUserResolverTest extends TestCase
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
    public function shouldRegisterAUser()
    {
        // Arrange
        $container = new Container();
        $this->mockHotelRepository->method('ofId')->willReturn($this->mockHotel);
        $container->set('hotelplex.query-repository.hotel', $this->mockHotelRepository);
        $container->set('hotelplex.command-repository.user', $this->mockUserRepository);
        $resolver = new RegisterUserResolver($container);
        $args = new Argument([
            'uuid' => $this->mockUser->uuid()->value(),
            'username' => $this->mockUser->username()->value(),
            'email' => $this->mockUser->email()->value(),
            'password' => $this->mockUser->password()->value(),
            'hotels' => join(',', $this->mockUser->hotels()->value())
        ]);
        // Action
        $response = $resolver->resolve($args);
        // Assert
        $this->assertSame(true, $response);
    }
}
