<?php

declare(strict_types=1);

namespace App\GraphQL\Hotel;

use Faker\Provider\Uuid;
use HotelPlex\Domain\Entity\Hotel\Hotel;
use HotelPlex\Domain\Exception\Hotel\HotelNotFoundException;
use HotelPlex\Domain\Repository\Hotel\HotelRepository;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerHotelFactory;
use Overblog\GraphQLBundle\Definition\Argument;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;

class HotelResolverTest extends TestCase
{
    /**
     * @var Hotel
     */
    private $mockHotel;
    /**
     * @var MockObject
     */
    private $mockHotelRepository;

    protected function setUp()
    {
        $this->mockHotel = FakerHotelFactory::create();
        $this->mockHotelRepository = $this->createMock(HotelRepository::class);
    }

    /**
     * @test
     */
    public function shouldReturnAHotelTypeGivenAnExistentUuid()
    {
        // Arrange
        $container = new Container();
        $this->mockHotelRepository->method('ofIdOrFail')->willReturn($this->mockHotel);
        $container->set('hotelplex.repository.hotel', $this->mockHotelRepository);
        $resolver = new HotelResolver($container);
        $args = new Argument([
            'uuid' => $this->mockHotel->uuid()->value()
        ]);
        $keys = [
            'uuid', 'name', 'address', 'phone', 'email', 'lift', 'wifi', 'accessibility',
            'parking', 'kitchen', 'pets', 'paymentMethods', 'logo', 'images'
        ];
        // Action
        $response = $resolver->resolve($args);
        // Assert
        $this->assertNotNull($response);
        foreach ($keys as $key) {
            $this->assertArrayHasKey($key, $response);
        }
    }

    /**
     * @test
     */
    public function shouldThrowAnHotelNotFoundExceptionGivenAnUnexistentHotelUuid()
    {
        // Arrange
        $container = new Container();
        $uuid = Uuid::uuid();
        $this->mockHotelRepository->method('ofIdOrFail')->willThrowException(
            HotelNotFoundException::withUUID($uuid)
        );
        $container->set('hotelplex.repository.hotel', $this->mockHotelRepository);
        $resolver = new HotelResolver($container);
        $args = new Argument([
            'uuid' => $uuid
        ]);
        // Assert
        $this->expectException(HotelNotFoundException::class);
        // Action
        $resolver->resolve($args);
    }
}
