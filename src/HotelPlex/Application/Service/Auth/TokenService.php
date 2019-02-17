<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service\Auth;

use HotelPlex\Application\Presenter\Auth\TokenPresenter;
use HotelPlex\Application\Service\Service;
use HotelPlex\Domain\Exception\Auth\AuthException;
use HotelPlex\Domain\Factory\Auth\TokenFactory;
use HotelPlex\Domain\Repository\Provider\ProviderRepository;
use HotelPlex\Domain\Repository\User\UserRepository;
use HotelPlex\Domain\Service\AuthService;

final class TokenService implements Service
{
    /**
     * @var AuthService
     */
    private $service;
    /**
     * @var TokenFactory
     */
    private $factory;

    /**
     * @param UserRepository $userRepository
     * @param ProviderRepository $providerRepository
     * @param TokenFactory $tokenFactory
     */
    public function __construct(UserRepository $userRepository, ProviderRepository $providerRepository, TokenFactory $tokenFactory)
    {
        $this->service = new AuthService($userRepository, $providerRepository);
        $this->factory = $tokenFactory;
    }

    /**
     * @param TokenRequest $request
     * @param TokenPresenter $presenter
     * @return TokenPresenter
     * @throws AuthException
     */
    public function __invoke($request, $presenter)
    {
        $userOrProvider = $this->service->__invoke($request->email(), $request->password());

        $token = $this->factory->build($userOrProvider);

        return $presenter->write($token);
    }
}
