<?php

declare(strict_types=1);

namespace HotelPlex\Tests\Infrastructure\Domain\Factory;

use Faker\Factory;
use Faker\Generator;
use HotelPlex\Domain\Entity\User\User;
use HotelPlex\Domain\Factory\User\UserFactory;
use HotelPlex\Domain\ValueObject\DateTimeValueObject;
use HotelPlex\Domain\ValueObject\UuidValueObject;

class FakerUserFactory implements UserFactory
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
     * @return User
     */
    public static function create(array $params = []): User
    {
        return (new self())->build($params);
    }

    /**
     * @param array $params
     * @return User
     */
    public function build(array $params = []): User
    {
        return new User(
            $params['uuid'] ?? new UuidValueObject($this->faker->uuid),
            $params['username'] ?? $this->faker->name,
            $params['email'] ?? $this->faker->address,
            $params['password'] ?? $this->faker->phoneNumber,
            $params['hotels'] ?? $this->faker->randomElement([
                [$this->faker->uuid]
            ]),
            $params['createdAt'] ?? new DateTimeValueObject($this->faker->dateTime),
            $params['updatedAt'] ?? new DateTimeValueObject($this->faker->dateTime)
        );
    }
}
