<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service\User;

use Closure;
use HotelPlex\Application\Presenter\EmptyPresenter;
use HotelPlex\Application\Service\Service;
use HotelPlex\Domain\Entity\User\User;
use HotelPlex\Domain\Exception\Hotel\HotelNotFoundException;
use HotelPlex\Domain\Repository\Hotel\HotelQueryRepository;
use HotelPlex\Domain\Repository\User\UserCommandRepository;
use HotelPlex\Domain\ValueObject\UuidValueObject;
use function Lambdish\Phunctional\each;

final class RegisterUserService implements Service
{
    /**
     * @var HotelQueryRepository
     */
    private $hotelQueryRepository;
    /**
     * @var UserCommandRepository
     */
    private $userCommandRepository;

    /**
     * @param HotelQueryRepository $hotelQueryRepository
     * @param UserCommandRepository $userCommandRepository
     */
    public function __construct(HotelQueryRepository $hotelQueryRepository, UserCommandRepository $userCommandRepository)
    {
        $this->hotelQueryRepository = $hotelQueryRepository;
        $this->userCommandRepository = $userCommandRepository;
    }

    /**
     * @param RegisterUserRequest $request
     * @param EmptyPresenter $presenter
     * @return mixed
     */
    public function __invoke($request, $presenter)
    {
        each($this->ensureHotelExist(), $request->hotels()->value());

        $user = User::register(
            $request->uuid(),
            $request->username(),
            $request->email(),
            $request->password(),
            $request->hotels()
        );

        $this->userCommandRepository->create($user);

        return $presenter;
    }

    /**
     * @return Closure
     */
    private function ensureHotelExist(): Closure
    {
        return function (string $hotelUuid) {
            $hotel = $this->hotelQueryRepository->ofId(new UuidValueObject($hotelUuid));

            if ($hotel === null) {
                throw HotelNotFoundException::withUUID($hotelUuid);
            }
        };
    }
}
