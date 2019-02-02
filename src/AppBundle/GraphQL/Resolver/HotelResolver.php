<?php

declare(strict_types=1);

namespace App\GraphQL\Resolver;

use HotelPlex\Application\Service\Hotel\HotelRequest;
use HotelPlex\Application\Service\Hotel\HotelService;
use HotelPlex\Domain\Entity\Hotel\Hotel;
use HotelPlex\Domain\Exception\Hotel\HotelNotFoundException;
use HotelPlex\Domain\Repository\Hotel\HotelRepository;
use HotelPlex\Domain\ValueObject\UuidValueObject;
use HotelPlex\Infrastructure\Presenter\ArrayHotelPresenter;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerHotelFactory;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class HotelResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @param Argument $args
     * @return mixed
     * @throws HotelNotFoundException
     */
    public function resolve(Argument $args)
    {
        $repository = new class implements HotelRepository {
            public function all(): array
            {
                return [FakerHotelFactory::create()];
            }

            public function ofIdOrFail(UuidValueObject $uuid): Hotel
            {
                return FakerHotelFactory::create();
            }
        };
        $request = new HotelRequest($args['uuid']);
        $service = new HotelService($repository);
        $presenter = new ArrayHotelPresenter();

        return $service->execute($request, $presenter)->read();
    }

    public static function getAliases()
    {
        return [
            'resolve' => 'HotelResolver'
        ];
    }
}
