<?php

declare(strict_types=1);

namespace HotelPlex\Tests\Infrastructure\Domain\Factory;

use Faker\Factory;
use Faker\Generator;
use HotelPlex\Domain\Entity\Payment\Payment;
use HotelPlex\Domain\Entity\Payment\PaymentAmount;
use HotelPlex\Domain\Entity\Payment\PaymentCreatedAt;
use HotelPlex\Domain\Entity\Payment\PaymentId;
use HotelPlex\Domain\Entity\Payment\PaymentMethod;
use HotelPlex\Domain\Factory\Payment\PaymentFactory;

class FakerPaymentFactory implements PaymentFactory
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
     * @return Payment
     */
    public static function create(array $params = []): Payment
    {
        return (new self())->build($params);
    }

    /**
     * @param array $params
     * @return Payment
     */
    public function build(array $params = []): Payment
    {
        return new Payment(
            $params['uuid'] ?? new PaymentId($this->faker->uuid),
            $params['paymentMethod'] ?? new PaymentMethod($this->faker->name),
            $params['amount'] ?? new PaymentAmount(
                $this->faker->currencyCode,
                $this->faker->numberBetween(1, 50)
            ),
            $params['createdAt'] ?? new PaymentCreatedAt($this->faker->dateTime)
        );
    }
}
