<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Repository\User;

use Doctrine\ORM\EntityManagerInterface;
use HotelPlex\Application\Mapper\User\UserMapper;
use HotelPlex\Domain\Entity\User\User;
use HotelPlex\Domain\Entity\User\UserPassword;
use HotelPlex\Domain\Repository\User\UserQueryRepository;
use HotelPlex\Infrastructure\Repository\DoctrineBaseRepository;

class DoctrineUserQueryRepository extends DoctrineBaseRepository implements UserQueryRepository
{
    /**
     * @var string
     */
    private $usersTable = 'users';

    /**
     * @var UserMapper
     */
    private $userMapper;

    /**
     * @param EntityManagerInterface $entityManager
     * @param UserMapper $userMapper
     */
    public function __construct(EntityManagerInterface $entityManager, UserMapper $userMapper)
    {
        parent::__construct($entityManager);
        $this->userMapper = $userMapper;
    }

    /**
     * @param string $email
     * @param string $password
     * @return User|null
     */
    public function ofEmailAndPassword(string $email, string $password): ?User
    {
        $item = $this->connection->createQueryBuilder()
            ->select('*')
            ->from($this->usersTable)
            ->where('email = :email')
            ->setParameter('email', $email)
            ->setMaxResults(1)
            ->execute()
            ->fetch();

        if ($item && !(new UserPassword($item['password'], false))->verify($password)) {
            $item = null;
        }

        return $item ? $this->userMapper->item($item) : null;
    }
}
