<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Service;

use HotelPlex\Domain\Entity\Provider\Provider;
use HotelPlex\Domain\Entity\User\User;
use HotelPlex\Domain\Exception\Auth\AuthException;
use HotelPlex\Domain\Repository\Provider\ProviderRepository;
use HotelPlex\Domain\Repository\User\UserRepository;

final class AuthService
{
    /**
     * @var UserRepository|ProviderRepository
     */
    private $repository;

    /**
     * @param UserRepository|ProviderRepository $repository
     * @throws AuthException
     */
    public function __construct($repository)
    {
        if ($repository === null || !($repository instanceof UserRepository || $repository instanceof ProviderRepository)) {
            throw AuthException::invalidRepository($repository ? get_class($repository) : 'null');
        }

        $this->repository = $repository;
    }

    /**
     * @param string $email
     * @param string $password
     * @return User|Provider
     * @throws AuthException
     */
    public function __invoke(string $email, string $password)
    {
        $userOrProvider = $this->repository->ofEmailAndPassword($email, $password);

        if ($userOrProvider === null) {
            throw AuthException::withEmail($email);
        }

        return $userOrProvider;
    }
}
