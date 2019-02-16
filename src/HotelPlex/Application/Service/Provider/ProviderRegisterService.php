<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service\Provider;

use HotelPlex\Application\Presenter\EmptyPresenter;
use HotelPlex\Application\Service\ProviderRegisterRequest;
use HotelPlex\Application\Service\Service;
use HotelPlex\Domain\Entity\Provider\Provider;
use HotelPlex\Domain\Entity\Provider\ProviderRepository;

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
    public function execute($request, $presenter)
    {
        $provider = Provider::register(
            $request->uuid(),
            $request->username(),
            $request->email(),
            $request->password(),
            $request->hotels()
        );

        $this->providerRepository->create($provider);

        return $presenter;
    }
}
