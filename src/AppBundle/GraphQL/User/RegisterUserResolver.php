<?php

declare(strict_types=1);

namespace App\GraphQL\User;

use App\GraphQL\BaseResolver;
use HotelPlex\Application\Presenter\EmptyPresenter;
use HotelPlex\Application\Service\User\RegisterUserRequest;
use HotelPlex\Application\Service\User\RegisterUserService;
use HotelPlex\Domain\Entity\User\UserHotelsException;
use HotelPlex\Domain\Exception\User\UserInvalidEmailException;
use Overblog\GraphQLBundle\Definition\Argument;

class RegisterUserResolver extends BaseResolver
{
    /**
     * @param Argument $args
     * @return mixed
     * @throws UserHotelsException
     * @throws UserInvalidEmailException
     */
    public function resolve(Argument $args)
    {
        (new RegisterUserService(
            $this->container->get('hotelplex.query-repository.hotel'),
            $this->container->get('hotelplex.command-repository.user')
        ))(
            new RegisterUserRequest(
                $args['uuid'],
                $args['username'],
                $args['email'],
                $args['password'],
                explode(',', $args['hotels'])
            ),
            new EmptyPresenter()
        );

        return true;
    }
}
