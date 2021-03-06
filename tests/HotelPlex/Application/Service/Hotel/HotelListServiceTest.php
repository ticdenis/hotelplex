<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service\Hotel;

use HotelPlex\Application\Presenter\Hotel\HotelListPresenter;
use HotelPlex\Application\Service\EmptyRequest;
use HotelPlex\Domain\Repository\Hotel\HotelQueryRepository;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerHotelFactory;
use PHPUnit\Framework\TestCase;

class HotelListServiceTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReturnAHotelListPresenterAfterExecute()
    {
        // Arrange
        $mockHotels = [FakerHotelFactory::create()];
        $mockRepository = $this->createMock(HotelQueryRepository::class);
        $mockRepository->method('all')->willReturn($mockHotels);
        /** @var HotelQueryRepository $mockRepository */
        $mockPresenter = $this->getMockForAbstractClass(HotelListPresenter::class);
        $mockPresenter->method('read')->willReturn($mockHotels);
        /** @var HotelListPresenter $mockPresenter */
        $service = new HotelListService($mockRepository);
        // Action
        $mockPresenter = $service->__invoke(new EmptyRequest(), $mockPresenter);
        $hotels = $mockPresenter->read();
        // Assert
        $this->assertNotEmpty($hotels);
        $this->assertArraySubset($mockHotels, $hotels);
    }
}
