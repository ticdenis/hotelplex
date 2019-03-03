<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use HotelPlex\Domain\Entity\Provider\ProviderPassword;
use HotelPlex\Domain\Entity\User\UserHotelsException;
use HotelPlex\Domain\Entity\User\UserPassword;
use HotelPlex\Domain\Exception\User\UserInvalidEmailException;
use HotelPlex\Domain\Repository\Provider\ProviderQueryRepository;
use HotelPlex\Domain\Repository\User\UserQueryRepository;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerProviderFactory;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerUserFactory;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

final class TokenPostControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var string
     */
    private $defaultPassword;
    /**
     * @var MockObject
     */
    private $mockUserRepository;
    /**
     * @var MockObject
     */
    private $mockProviderRepository;

    protected function setUp()
    {
        $this->client = static::createClient();
        $this->defaultPassword = 'secret';
        $this->mockUserRepository = $this->createMock(UserQueryRepository::class);
        $this->mockProviderRepository = $this->createMock(ProviderQueryRepository::class);
    }

    /**
     * @test
     *
     * @throws UserHotelsException
     * @throws UserInvalidEmailException
     */
    public function shouldReturnATokenAndCreatedHTTPCodeAsAUser()
    {
        // Arrange
        $user = FakerUserFactory::create([
            'password' => new UserPassword($this->defaultPassword)
        ]);
        $this->mockUserRepository->method('ofEmailAndPassword')->willReturn($user);
        $this->client->getContainer()->set('hotelplex.query-repository.user', $this->mockUserRepository);
        $this->mockProviderRepository->method('ofEmailAndPassword')->willReturn(null);
        $this->client->getContainer()->set('hotelplex.query-repository.provider', $this->mockProviderRepository);
        // Action
        $this->client->request('POST', '/auth/token', [
            'email' => $user->email()->value(),
            'password' => $this->defaultPassword,
        ]);
        // Assert
        $this->customAssert(JsonResponse::HTTP_CREATED);
    }

    /**
     * @test
     */
    public function shouldReturnATokenAndCreatedHTTPCodeAsAProvider()
    {
        // Arrange
        $provider = FakerProviderFactory::create([
            'password' => new ProviderPassword($this->defaultPassword)
        ]);
        $this->mockUserRepository->method('ofEmailAndPassword')->willReturn(null);
        $this->client->getContainer()->set('hotelplex.query-repository.user', $this->mockUserRepository);
        $this->mockProviderRepository->method('ofEmailAndPassword')->willReturn($provider);
        $this->client->getContainer()->set('hotelplex.query-repository.provider', $this->mockProviderRepository);
        // Action
        $this->client->request('POST', '/auth/token', [
            'email' => $provider->email()->value(),
            'password' => $this->defaultPassword,
        ]);
        // Assert
        $this->customAssert(JsonResponse::HTTP_CREATED);
    }

    /**
     * @test
     */
    public function shouldReturnAnErrorAndUnauthorizedHTTPCode()
    {
        // Action
        $this->client->request('POST', '/auth/token', [
            'email' => 'token-post-controller-test@hotelplex.com',
            'password' => 'secret',
        ]);
        // Assert
        $this->customAssert(JsonResponse::HTTP_UNAUTHORIZED);
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
