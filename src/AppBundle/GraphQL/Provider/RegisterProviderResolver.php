<?php

declare(strict_types=1);

namespace App\GraphQL\Provider;

use App\GraphQL\BaseResolver;
use HotelPlex\Application\Presenter\EmptyPresenter;
use HotelPlex\Application\Service\Provider\ProviderRegisterRequest;
use HotelPlex\Application\Service\Provider\RegisterProviderService;
use Overblog\GraphQLBundle\Definition\Argument;

class RegisterProviderResolver extends BaseResolver
{
    /**
     * @param Argument $args
     * @return mixed
     */
    public function resolve(Argument $args)
    {
        (new RegisterProviderService(
            $this->container->get('hotelplex.command-repository.provider')
        ))(
            new ProviderRegisterRequest(
                $args['uuid'],
                $args['username'],
                $args['email'],
                $args['password']
            ),
            new EmptyPresenter()
        );

        return true;
    }
}
