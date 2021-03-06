<?php

declare(strict_types=1);

namespace HotelPlex\Tests\Infrastructure\Domain\Factory;

use Faker\Factory;
use Faker\Generator;
use HotelPlex\Domain\Entity\Provider\Provider;
use HotelPlex\Domain\Entity\Provider\ProviderEmail;
use HotelPlex\Domain\Entity\Provider\ProviderId;
use HotelPlex\Domain\Entity\Provider\ProviderPassword;
use HotelPlex\Domain\Entity\Provider\ProviderUsername;
use HotelPlex\Domain\Factory\Provider\ProviderFactory;

class FakerProviderFactory implements ProviderFactory
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
     * @return Provider
     */
    public static function create(array $params = []): Provider
    {
        return (new self())->build($params);
    }

    /**
     * @param array $params
     * @return Provider
     */
    public function build(array $params = []): Provider
    {
        return new Provider(
            $params['uuid'] ?? new ProviderId($this->faker->uuid),
            $params['username'] ?? new ProviderUsername($this->faker->name),
            $params['email'] ?? new ProviderEmail($this->faker->email),
            $params['password'] ?? new ProviderPassword($this->faker->password)
        );
    }
}
