<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Service;

use HotelPlex\Domain\Entity\Provider\Provider;
use HotelPlex\Domain\Entity\User\User;
use HotelPlex\Domain\Exception\Auth\AuthException;
use HotelPlex\Domain\Repository\Provider\ProviderQueryRepository;
use HotelPlex\Domain\Repository\User\UserQueryRepository;

final class AuthService
{
    /**
     * @var UserQueryRepository
     */
    private $userRepository;
    /**
     * @var ProviderQueryRepository
     */
    private $providerRepository;

    /**
     * @param UserQueryRepository $userRepository
     * @param ProviderQueryRepository $providerRepository
     */
    public function __construct(UserQueryRepository $userRepository, ProviderQueryRepository $providerRepository)
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
