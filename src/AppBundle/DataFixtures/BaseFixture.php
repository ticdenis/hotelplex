<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;

abstract class BaseFixture extends Fixture
{
    /**
     * @var EntityManager
     */
    protected $entityManager;
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $connection;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->connection = $entityManager->getConnection();
    }

}
