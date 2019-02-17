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
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ProviderRepository
     */
    private $providerRepository;

    /**
     * @param UserRepository $userRepository
     * @param ProviderRepository $providerRepository
     */
    public function __construct(UserRepository $userRepository, ProviderRepository $providerRepository)
    {
        $this->userRepository = $userRepository;
        $this->providerRepository = $providerRepository;
    }

    /**
     * @param string $email
     * @param string $password
     * @return User|Provider
     * @throws AuthException
     */
    public function __invoke(string $email, string $password)
    {
        $userOrProvider = $this->userRepository->ofEmailAndPassword($email, $password);

        if ($userOrProvider === null) {
            $userOrProvider = $this->providerRepository->ofEmailAndPassword($email, $password);
        }

        if ($userOrProvider === null) {
            throw AuthException::withEmail($email);
        }

        return $userOrProvider;
    }
}
