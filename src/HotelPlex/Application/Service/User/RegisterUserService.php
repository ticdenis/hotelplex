<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service\User;

use HotelPlex\Application\Presenter\EmptyPresenter;
use HotelPlex\Application\Service\Service;
use HotelPlex\Domain\Entity\User\User;
use HotelPlex\Domain\Repository\User\UserCommandRepository;

final class RegisterUserService implements Service
{
    /**
     * @var UserCommandRepository
     */
    private $repository;

    public function __construct(UserCommandRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param RegisterUserRequest $request
     * @param EmptyPresenter $presenter
     * @return mixed
     */
    public function __invoke($request, $presenter)
    {
        $user = User::register(
            $request->uuid(),
            $request->username(),
            $request->email(),
            $request->password(),
            $request->hotels()
        );

        $this->repository->create($user);

        return $presenter;
    }
}
