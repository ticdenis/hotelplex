<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Service;

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
        $this->guardRepository($repository);

        $this->repository = $repository;
    }

    /**
     * @param $repository
     * @throws AuthException
     */
    private function guardRepository($repository)
    {
        if (!($repository instanceof UserRepository || $repository instanceof ProviderRepository)) {
            throw AuthException::invalidRepository(get_class($repository));
        }
    }

    /**
     * @param string $email
     * @param string $password
     * @return User|Provider
     * @throws AuthException
     */
    public function __invoke(string $email, string $password)
    {
        if (!$userOrProvider = $this->repository->ofEmailAndPassword($email, $password)) {
            throw AuthException::withEmail($email);
        }

        return $userOrProvider;
    }
}
