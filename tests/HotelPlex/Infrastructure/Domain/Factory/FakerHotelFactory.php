<?php

declare(strict_types=1);

namespace HotelPlex\Tests\Infrastructure\Domain\Factory;

use Faker\Factory;
use Faker\Generator;
use HotelPlex\Domain\Entity\Hotel\Hotel;
use HotelPlex\Domain\Factory\Hotel\HotelFactory;
use HotelPlex\Domain\ValueObject\DateTimeValueObject;
use HotelPlex\Domain\ValueObject\UuidValueObject;

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
            $params['uuid'] ?? new UuidValueObject($this->faker->uuid),
            $params['name'] ?? $this->faker->name,
            $params['address'] ?? $this->faker->address,
            $params['phone'] ?? $this->faker->phoneNumber,
            $params['email'] ?? $this->faker->email,
            $params['lift'] ?? $this->faker->boolean,
            $params['wifi'] ?? $this->faker->boolean,
            $params['accessibility'] ?? $this->faker->boolean,
            $params['parking'] ?? $this->faker->boolean,
            $params['kitchen'] ?? $this->faker->boolean,
            $params['pets'] ?? $this->faker->boolean,
            $params['paymentMethods'] ?? $this->faker->randomElement([
                [],
                ['VISA']
            ]),
            $params['logo'] ?? $this->faker->randomElement([
                null,
                $this->faker->imageUrl()
            ]),
            $params['images'] ?? $this->faker->randomElement([
                [],
                [$this->faker->imageUrl(), $this->faker->imageUrl(), $this->faker->imageUrl()]
            ]),
            $params['createdAt'] ?? new DateTimeValueObject($this->faker->dateTime),
            $params['updatedAt'] ?? new DateTimeValueObject($this->faker->dateTime)
        );
    }
}
