<?php

declare(strict_types=1);

namespace HotelPlex\Tests\Domain\Entity\Hotel;

use HotelPlex\Domain\Entity\Hotel\Hotel;
use HotelPlex\Domain\Event\DomainEventPublisher;
use HotelPlex\Domain\Event\Hotel\HotelRegistered;
use HotelPlex\Domain\Event\Hotel\HotelUpdatedInfo;
use HotelPlex\Tests\Infrastructure\Domain\Event\SpyDomainEventListener;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerHotelFactory;
use PHPUnit\Framework\TestCase;

class HotelTest extends TestCase
{
    /**
     * @var Hotel
     */
    private $hotel;
    /**
     * @var array
     */
    private $payload;

    protected function setUp()
    {
        $this->hotel = FakerHotelFactory::create();
        $this->payload = [
            'name' => $this->hotel->name(),
            'address' => $this->hotel->address(),
            'phone' => $this->hotel->phone(),
            'email' => $this->hotel->email(),
            'lift' => $this->hotel->lift(),
            'wifi' => $this->hotel->wifi(),
            'accessibility' => $this->hotel->accessibility(),
            'parking' => $this->hotel->parking(),
            'kitchen' => $this->hotel->kitchen(),
            'pets' => $this->hotel->pets()
        ];
    }

    /**
     * @test
     */
    public function shouldCreateANewHotel()
    {
        // Action
        $hotel = Hotel::register(...array_values($this->payload));
        // Assert
        $this->assertInstanceOf(Hotel::class, $hotel);
        $this->assertNotNull($hotel->uuid());
        $this->assertArraySubset($this->payload, [
            'name' => $hotel->name(),
            'address' => $hotel->address(),
            'phone' => $hotel->phone(),
            'email' => $hotel->email(),
            'lift' => $hotel->lift(),
            'wifi' => $hotel->wifi(),
            'accessibility' => $hotel->accessibility(),
            'parking' => $hotel->parking(),
            'kitchen' => $hotel->kitchen(),
            'pets' => $hotel->pets()
        ]);
        $this->assertEmpty($hotel->paymentMethods());
        $this->assertNull($hotel->logo());
        $this->assertEmpty($hotel->images());
    }

    /**
     * @test
     */
    public function shouldPublishHotelRegisteredDomainEvent()
    {
        // Arrange
        $listener = new SpyDomainEventListener();
        // Action
        $listenerId = DomainEventPublisher::instance()->subscribe($listener);
        $hotel = Hotel::register(...array_values($this->payload));
        /** @type HotelRegistered $hotelRegistered */
        $hotelRegistered = $listener->domainEvent();
        DomainEventPublisher::instance()->unsubscribe($listenerId);
        // Arrange
        $this->assertInstanceOf(HotelRegistered::class, $hotelRegistered);
        $this->assertSame($hotel->uuid()->value(), $hotelRegistered->uuid());
        $this->assertArraySubset($this->payload, [
            'name' => $hotelRegistered->name(),
            'address' => $hotelRegistered->address(),
            'phone' => $hotelRegistered->phone(),
            'email' => $hotelRegistered->email(),
            'lift' => $hotelRegistered->lift(),
            'wifi' => $hotelRegistered->wifi(),
            'accessibility' => $hotelRegistered->accessibility(),
            'parking' => $hotelRegistered->parking(),
            'kitchen' => $hotelRegistered->kitchen(),
            'pets' => $hotelRegistered->pets()
        ]);
        $this->assertNotNull($hotelRegistered->occurredOn());
    }

    /**
     * @test
     */
    public function shouldUpdateInfoHotel()
    {
        // Arrange
        $fakeHotel = FakerHotelFactory::create();
        $payload = [
            'name' => $fakeHotel->name(),
            'address' => $fakeHotel->address(),
            'phone' => $fakeHotel->phone(),
            'email' => $fakeHotel->email(),
            'lift' => $fakeHotel->lift(),
            'wifi' => $fakeHotel->wifi(),
            'accessibility' => $fakeHotel->accessibility(),
            'parking' => $fakeHotel->parking(),
            'kitchen' => $fakeHotel->kitchen(),
            'pets' => $fakeHotel->pets(),
            'paymentMethods' => $fakeHotel->paymentMethods(),
            'logo' => $fakeHotel->logo(),
            'images' => $fakeHotel->images()
        ];
        $hotel = clone $this->hotel;
        // Action
        $hotel->updateInfo(...array_values($payload));
        // Assert
        $this->assertArraySubset([
            'name' => $hotel->name(),
            'address' => $hotel->address(),
            'phone' => $hotel->phone(),
            'email' => $hotel->email(),
            'lift' => $hotel->lift(),
            'wifi' => $hotel->wifi(),
            'accessibility' => $hotel->accessibility(),
            'parking' => $hotel->parking(),
            'kitchen' => $hotel->kitchen(),
            'pets' => $hotel->pets(),
            'paymentMethods' => $hotel->paymentMethods(),
            'logo' => $hotel->logo(),
            'images' => $hotel->images()
        ], $payload);
    }

    /**
     * @test
     */
    public function shouldPublishHotelUpdatedInfoDomainEvent()
    {
        // Arrange
        $fakeHotel = FakerHotelFactory::create();
        $payload = [
            'name' => $fakeHotel->name(),
            'address' => $fakeHotel->address(),
            'phone' => $fakeHotel->phone(),
            'email' => $fakeHotel->email(),
            'lift' => $fakeHotel->lift(),
            'wifi' => $fakeHotel->wifi(),
            'accessibility' => $fakeHotel->accessibility(),
            'parking' => $fakeHotel->parking(),
            'kitchen' => $fakeHotel->kitchen(),
            'pets' => $fakeHotel->pets(),
            'paymentMethods' => $fakeHotel->paymentMethods(),
            'logo' => $fakeHotel->logo(),
            'images' => $fakeHotel->images()
        ];
        $hotel = clone $this->hotel;
        $listener = new SpyDomainEventListener();
        // Action
        $listenerId = DomainEventPublisher::instance()->subscribe($listener);
        $hotel->updateInfo(...array_values($payload));
        /** @type HotelUpdatedInfo $hotelUpdatedInfo */
        $hotelUpdatedInfo = $listener->domainEvent();
        DomainEventPublisher::instance()->unsubscribe($listenerId);
        // Arrange
        $this->assertInstanceOf(HotelUpdatedInfo::class, $hotelUpdatedInfo);
        $this->assertSame($hotel->uuid()->value(), $hotelUpdatedInfo->uuid());
        $this->assertArraySubset($payload, [
            'name' => $hotelUpdatedInfo->name(),
            'address' => $hotelUpdatedInfo->address(),
            'phone' => $hotelUpdatedInfo->phone(),
            'email' => $hotelUpdatedInfo->email(),
            'lift' => $hotelUpdatedInfo->lift(),
            'wifi' => $hotelUpdatedInfo->wifi(),
            'accessibility' => $hotelUpdatedInfo->accessibility(),
            'parking' => $hotelUpdatedInfo->parking(),
            'kitchen' => $hotelUpdatedInfo->kitchen(),
            'pets' => $hotelUpdatedInfo->pets(),
            'paymentMethods' => $hotelUpdatedInfo->paymentMethods(),
            'logo' => $hotelUpdatedInfo->logo(),
            'images' => $hotelUpdatedInfo->images()
        ]);
        $this->assertNotNull($hotelUpdatedInfo->occurredOn());
    }
}
