<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Repository\Provider;

use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;
use HotelPlex\Application\Mapper\Provider\ProviderMapper;
use HotelPlex\Domain\Entity\Provider\Provider;
use HotelPlex\Domain\Repository\Provider\ProviderRepository;
use HotelPlex\Infrastructure\Repository\DoctrineBaseRepository;

class DoctrineProviderRepository extends DoctrineBaseRepository implements ProviderRepository
{
    /**
     * @var string
     */
    private $providersTable = 'providers';

    /**
     * @var ProviderMapper
     */
    private $providerMapper;

    /**
     * @param EntityManagerInterface $entityManager
     * @param ProviderMapper $providerMapper
     */
    public function __construct(EntityManagerInterface $entityManager, ProviderMapper $providerMapper)
    {
        parent::__construct($entityManager);
        $this->providerMapper = $providerMapper;
    }

    /**
     * @param string $email
     * @param string $password
     * @return Provider|null
     */
    public function ofEmailAndPassword(string $email, string $password): ?Provider
    {
        $item = $this->connection->createQueryBuilder()
            ->select('*')
            ->from($this->providersTable)
            ->where('email = :email')
            ->where('password = :password')
            ->setParameter('email', $email)
            ->setParameter('password', $password)
            ->setMaxResults(1)
            ->execute()
            ->fetch();

        return $item ? $this->providerMapper->item($item) : null;
    }

    /**
     * @param Provider $provider
     * @throws DBALException
     */
    public function create(Provider $provider): void
    {
        $this->connection->insert($this->providersTable,
            [
                $provider->uuid()->value(), $provider->username(), $provider->email()->value(),
                $provider->password()->value(), $provider->createdAt()->value()->getTimestamp(),
                $provider->updatedAt()->value()->getTimestamp()
            ]);
    }
}
