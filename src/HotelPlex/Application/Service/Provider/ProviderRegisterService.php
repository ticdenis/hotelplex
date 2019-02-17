<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service\Provider;

use HotelPlex\Application\Presenter\EmptyPresenter;
use HotelPlex\Application\Service\Service;
use HotelPlex\Domain\Entity\Provider\Provider;
use HotelPlex\Domain\Repository\Provider\ProviderRepository;

final class ProviderRegisterService implements Service
{

    /**
     * @var ProviderRepository
     */
    private $providerRepository;

    public function __construct(ProviderRepository $providerRepository)
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
