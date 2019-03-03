<?php

declare(strict_types=1);

namespace HotelPlex\Tests\Infrastructure\Domain\Factory;

use Faker\Factory;
use Faker\Generator;
use HotelPlex\Domain\Entity\Hotel\Room\Room;
use HotelPlex\Domain\Entity\Hotel\Room\RoomCurrency;
use HotelPlex\Domain\Entity\Hotel\Room\RoomDoubleBeds;
use HotelPlex\Domain\Entity\Hotel\Room\RoomDoublePrice;
use HotelPlex\Domain\Entity\Hotel\Room\RoomId;
use HotelPlex\Domain\Entity\Hotel\Room\RoomImages;
use HotelPlex\Domain\Entity\Hotel\Room\RoomIndividualBeds;
use HotelPlex\Domain\Entity\Hotel\Room\RoomIndividualPrice;
use HotelPlex\Domain\Exception\Hotel\RoomBedException;
use HotelPlex\Domain\Exception\Hotel\RoomImagesException;
use HotelPlex\Domain\Factory\Hotel\RoomFacilitiesFactory;
use HotelPlex\Domain\Factory\Hotel\RoomFactory;

class FakerRoomFactory implements RoomFactory
{
    /**
     * @var Generator
     */
    private $faker;
    /**
     * @var Generator|null
     */
    private $generator;
    /**
     * @var RoomFacilitiesFactory
     */
    private $facilitiesFactory;

    /**
     * @param Generator|null $generator
     * @param RoomFacilitiesFactory|null $facilitiesFactory
     */
    public function __construct(Generator $generator = null, RoomFacilitiesFactory $facilitiesFactory = null)
    {
        $this->faker = $generator ?? Factory::create();
        $this->generator = $generator;
        $this->facilitiesFactory = $facilitiesFactory ? $facilitiesFactory : new FakerRoomFacilitiesFactory($generator);
    }

    /**
     * @param array $params
     * @return Room
     * @throws RoomBedException
     * @throws RoomImagesException
     */
    public static function create(array $params = []): Room
    {
        return (new self())->build($params);
    }

    /**
     * @param array $params
     * @return Room
     * @throws RoomImagesException
     * @throws RoomBedException
     */
    public function build(array $params = []): Room
    {
        return new Room(
            $params['uuid'] ?? new RoomId($this->faker->uuid),
            $params['currency'] ?? new RoomCurrency($this->faker->currencyCode),
            $params['facilities'] ?? $this->facilitiesFactory->build(),
            $params['individualPrice'] ?? new RoomIndividualPrice($this->faker->numberBetween(0, 50)),
            $params['individualBeds'] ?? new RoomIndividualBeds([0 => true, 1 => false]),
            $params['doublePrice'] ?? new RoomDoublePrice($this->faker->numberBetween(0, 100)),
            $params['doubleBeds'] ?? new RoomDoubleBeds([0 => true, 1 => false]),
            new RoomImages($params['images'] ?? $this->faker->randomElement([
                [],
                [$this->faker->imageUrl(), $this->faker->imageUrl(), $this->faker->imageUrl()]
            ]))
        );
    }
}
