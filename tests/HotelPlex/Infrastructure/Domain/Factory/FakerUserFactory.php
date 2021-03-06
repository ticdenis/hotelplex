<?php

declare(strict_types=1);

namespace HotelPlex\Tests\Infrastructure\Domain\Factory;

use Faker\Factory;
use Faker\Generator;
use HotelPlex\Domain\Entity\User\User;
use HotelPlex\Domain\Entity\User\UserEmail;
use HotelPlex\Domain\Entity\User\UserHotels;
use HotelPlex\Domain\Entity\User\UserHotelsException;
use HotelPlex\Domain\Entity\User\UserId;
use HotelPlex\Domain\Entity\User\UserPassword;
use HotelPlex\Domain\Entity\User\UserUsername;
use HotelPlex\Domain\Exception\User\UserInvalidEmailException;
use HotelPlex\Domain\Factory\User\UserFactory;

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
     * @throws UserHotelsException
     * @throws UserInvalidEmailException
     */
    public static function create(array $params = []): User
    {
        return (new self())->build($params);
    }

    /**
     * @param array $params
     * @return User
     * @throws UserHotelsException
     * @throws UserInvalidEmailException
     */
    public function build(array $params = []): User
    {
        return new User(
            $params['uuid'] ?? new UserId($this->faker->uuid),
            $params['username'] ?? new UserUsername($this->faker->name),
            $params['email'] ?? new UserEmail($this->faker->email),
            $params['password'] ?? new UserPassword($this->faker->password),
            new UserHotels($params['hotels'] ?? $this->faker->randomElement([[$this->faker->uuid]]))
        );
    }
}
