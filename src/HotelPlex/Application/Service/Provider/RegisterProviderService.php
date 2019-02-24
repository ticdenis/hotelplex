<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service\Provider;

use HotelPlex\Application\Presenter\EmptyPresenter;
use HotelPlex\Application\Service\Service;
use HotelPlex\Domain\Entity\Provider\Provider;
use HotelPlex\Domain\Repository\Provider\ProviderCommandRepository;

final class RegisterProviderService implements Service
{

    /**
     * @var ProviderCommandRepository
     */
    private $providerRepository;

    public function __construct(ProviderCommandRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    /**
     * @param ProviderRegisterRequest $request
     * @param EmptyPresenter $presenter
     * @return mixed
     */
    public function __invoke($request, $presenter)
    {
        $provider = Provider::register(
            $request->uuid(),
            $request->username(),
            $request->email(),
            $request->password()
        );

        $this->providerRepository->create($provider);

        return $presenter;
    }
}
