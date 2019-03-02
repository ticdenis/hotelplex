<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Repository\User;

use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;
use HotelPlex\Domain\Entity\User\User;
use HotelPlex\Domain\Repository\User\UserCommandRepository;
use HotelPlex\Infrastructure\Repository\DoctrineBaseRepository;

class DoctrineUserCommandRepository extends DoctrineBaseRepository implements UserCommandRepository
{
    /**
     * @var string
     */
    private $usersTable = 'users';

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
    }

    /**
     * @param User $user
     * @throws DBALException
     */
    public function create(User $user): void
    {
        $this->connection->insert($this->usersTable, [
            'uuid' => $user->uuid()->value(),
            'username' => $user->username()->value(),
            'email' => $user->email()->value(),
            'password' => $user->password()->value(),
            'hotels' => join(',', $user->hotels()->value()),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
