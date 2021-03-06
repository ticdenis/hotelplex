<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Repository\Provider;

use Doctrine\ORM\EntityManagerInterface;
use HotelPlex\Application\Mapper\Provider\ProviderMapper;
use HotelPlex\Domain\Entity\Provider\Provider;
use HotelPlex\Domain\Repository\Provider\ProviderQueryRepository;
use HotelPlex\Infrastructure\Repository\DoctrineBaseRepository;

class DoctrineProviderQueryRepository extends DoctrineBaseRepository implements ProviderQueryRepository
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
}
