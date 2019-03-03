<?php

declare(strict_types=1);

namespace HotelPlex\Tests\Infrastructure\Domain\Factory;

use Faker\Factory;
use Faker\Generator;
use HotelPlex\Domain\Entity\Hotel\Room\RoomAccessibility;
use HotelPlex\Domain\Entity\Hotel\Room\RoomAirConditioning;
use HotelPlex\Domain\Entity\Hotel\Room\RoomFacilities;
use HotelPlex\Domain\Entity\Hotel\Room\RoomHeating;
use HotelPlex\Domain\Entity\Hotel\Room\RoomLocker;
use HotelPlex\Domain\Entity\Hotel\Room\RoomShower;
use HotelPlex\Domain\Entity\Hotel\Room\RoomTv;
use HotelPlex\Domain\Entity\Hotel\Room\RoomWardrobe;
use HotelPlex\Domain\Entity\Hotel\Room\RoomWc;
use HotelPlex\Domain\Factory\Hotel\RoomFacilitiesFactory;

class FakerRoomFacilitiesFactory implements RoomFacilitiesFactory
{
    /**
     * @var Generator
     */
    private $faker;

    /**
     * @param Generator|null $generator
     */
    public function __construct(Generator $generator = null)
    {
        $this->faker = $generator ?? Factory::create();
    }

    /**
     * @param array $params
     * @return RoomFacilities
     */
    public static function create(array $params = []): RoomFacilities
    {
        return (new self())->build($params);
    }

    /**
     * @param array $params
     * @return RoomFacilities
     */
    public function build(array $params = []): RoomFacilities
    {
        return new RoomFacilities(
            $params['tv'] ?? new RoomTv($this->faker->boolean),
            $params['heating'] ?? new RoomHeating($this->faker->boolean),
            $params['airConditioning'] ?? new RoomAirConditioning($this->faker->boolean),
            $params['wc'] ?? new RoomWc($this->faker->boolean),
            $params['shower'] ?? new RoomShower($this->faker->boolean),
            $params['wardrobe'] ?? new RoomWardrobe($this->faker->boolean),
            $params['locker'] ?? new RoomLocker($this->faker->boolean),
            $params['accessibility'] ?? new RoomAccessibility($this->faker->boolean),
        );
    }
}
