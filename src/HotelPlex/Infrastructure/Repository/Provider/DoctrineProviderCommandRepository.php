<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Repository\Provider;

use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;
use HotelPlex\Domain\Entity\Provider\Provider;
use HotelPlex\Domain\Repository\Provider\ProviderCommandRepository;
use HotelPlex\Domain\ValueObject\DateTimeValueObject;
use HotelPlex\Infrastructure\Repository\DoctrineBaseRepository;

class DoctrineProviderCommandRepository extends DoctrineBaseRepository implements ProviderCommandRepository
{
    /**
     * @var string
     */
    private $providersTable = 'providers';

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
    }

    /**
     * @param Provider $provider
     * @throws DBALException
     */
    public function create(Provider $provider): void
    {
        $this->connection->insert($this->providersTable, [
            'uuid' => $provider->uuid()->value(),
            'username' => $provider->username()->value(),
            'email' => $provider->email()->value(),
            'password' => $provider->password()->value(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
