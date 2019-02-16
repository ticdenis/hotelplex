<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service\Hotel;

use HotelPlex\Application\Presenter\Hotel\HotelPresenter;
use HotelPlex\Domain\Entity\Hotel\Hotel;
use HotelPlex\Domain\Exception\Hotel\HotelNotFoundException;
use HotelPlex\Domain\Repository\Hotel\HotelRepository;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerHotelFactory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class HotelServiceTest extends TestCase
{
    /**
     * @var Hotel
     */
    private $mockHotel;
    /**
     * @var MockObject
     */
    private $mockRepository;
    /**
     * @var MockObject
     */
    private $mockPresenter;
    /**
     * @var MockObject
     */
    private $mockRequest;

    protected function setUp()
    {
        $this->mockHotel = FakerHotelFactory::create();
        $this->mockRepository = $this->createMock(HotelRepository::class);
        $this->mockPresenter = $this->getMockForAbstractClass(HotelPresenter::class);
        $this->mockRequest = $this->createMock(HotelRequest::class);
    }

    /**
     * @test
     * @throws HotelNotFoundException
     */
    public function shouldReturnAHotelInfoPresenter()
    {
        // Arrange
        $this->mockRepository->method('ofIdOrFail')->willReturn($this->mockHotel);
        $this->mockPresenter->method('read')->willReturn($this->mockHotel);
        $service = new HotelService($this->mockRepository);
        $this->mockRequest->method('uuid')->willReturn($this->mockHotel->uuid());
        // Action
        $this->mockPresenter = $service->__invoke($this->mockRequest, $this->mockPresenter);
        $hotel = $this->mockPresenter->read();
        // Assert
        $this->assertNotNull($hotel);
        $this->assertSame($this->mockHotel, $hotel);
    }

    /**
     * @test
     */
    public function shouldThrowAHotelNotFoundException()
    {
        // Arrange
        $this->mockRepository->method('ofIdOrFail')->willThrowException(
            HotelNotFoundException::withUUID($this->mockHotel->uuid()->value())
        );
        $service = new HotelService($this->mockRepository);
        // Assert
        $this->expectException(HotelNotFoundException::class);
        // Action
        $service->__invoke($this->mockRequest, $this->mockPresenter);
    }
}
