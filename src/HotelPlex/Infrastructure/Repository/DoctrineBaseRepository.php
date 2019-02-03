<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;

abstract class DoctrineBaseRepository
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->connection = $entityManager->getConnection();
    }
}
