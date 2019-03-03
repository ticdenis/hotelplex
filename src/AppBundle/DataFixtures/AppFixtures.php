<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\DBAL\Connection;

class AppFixtures extends Fixture
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        (new HotelFixture())->load($this->connection);
        (new UserFixture())->load($this->connection);
        (new ProviderFixture())->load($this->connection);
        (new CurrencyFixture())->load($this->connection);
        (new PaymentFixture())->load($this->connection);
        (new RoomFixture())->load($this->connection);
    }
}
