<?php

declare(strict_types=1);

namespace HotelPlex\Tests\Infrastructure\Domain\Factory;

use Faker\Factory;
use Faker\Generator;
use HotelPlex\Domain\Entity\Hotel\Hotel;
use HotelPlex\Domain\Entity\Hotel\HotelAccessibility;
use HotelPlex\Domain\Entity\Hotel\HotelAddress;
use HotelPlex\Domain\Entity\Hotel\HotelEmail;
use HotelPlex\Domain\Entity\Hotel\HotelId;
use HotelPlex\Domain\Entity\Hotel\HotelImages;
use HotelPlex\Domain\Entity\Hotel\HotelKitchen;
use HotelPlex\Domain\Entity\Hotel\HotelLift;
use HotelPlex\Domain\Entity\Hotel\HotelLogo;
use HotelPlex\Domain\Entity\Hotel\HotelName;
use HotelPlex\Domain\Entity\Hotel\HotelParking;
use HotelPlex\Domain\Entity\Hotel\HotelPaymentMethods;
use HotelPlex\Domain\Entity\Hotel\HotelPets;
use HotelPlex\Domain\Entity\Hotel\HotelPhone;
use HotelPlex\Domain\Entity\Hotel\HotelWifi;
use HotelPlex\Domain\Factory\Hotel\HotelFactory;

class FakerHotelFactory implements HotelFactory
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
     * @return Hotel
     */
    public static function create(array $params = []): Hotel
    {
        return (new self())->build($params);
    }

    /**
     * @param array $params
     * @return Hotel
     */
    public function build(array $params = []): Hotel
    {
        return new Hotel(
            $params['uuid'] ?? new HotelId($this->faker->uuid),
            $params['name'] ?? new HotelName($this->faker->name),
            $params['address'] ?? new HotelAddress($this->faker->address),
            $params['phone'] ?? new HotelPhone($this->faker->phoneNumber),
            $params['email'] ?? new HotelEmail($this->faker->email),
            $params['lift'] ?? new HotelLift($this->faker->boolean),
            $params['wifi'] ?? new HotelWifi($this->faker->boolean),
            $params['accessibility'] ?? new HotelAccessibility($this->faker->boolean),
            $params['parking'] ?? new HotelParking($this->faker->boolean),
            $params['kitchen'] ?? new HotelKitchen($this->faker->boolean),
            $params['pets'] ?? new HotelPets($this->faker->boolean),
            $params['paymentMethods'] ?? new HotelPaymentMethods($this->faker->randomElement([
                [],
                ['VISA']
            ])),
            $params['logo'] ?? new HotelLogo($this->faker->randomElement([
                null,
                $this->faker->imageUrl()
            ])),
            $params['images'] ?? new HotelImages($this->faker->randomElement([
                [],
                [$this->faker->imageUrl(), $this->faker->imageUrl(), $this->faker->imageUrl()]
            ]))
        );
    }
}
