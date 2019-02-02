<?php

declare(strict_types=1);

namespace App\GraphQL\Resolver;

use HotelPlex\Application\Service\EmptyRequest;
use HotelPlex\Application\Service\Hotel\HotelListService;
use HotelPlex\Domain\Entity\Hotel\Hotel;
use HotelPlex\Domain\Repository\Hotel\HotelRepository;
use HotelPlex\Domain\ValueObject\UuidValueObject;
use HotelPlex\Infrastructure\Presenter\ArrayHotelListPresenter;
use HotelPlex\Infrastructure\Presenter\ArrayHotelPresenter;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerHotelFactory;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class HotelsResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @return mixed
     */
    public function resolve()
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
        $request = new EmptyRequest();
        $service = new HotelListService($repository);
        $presenter = new ArrayHotelListPresenter(new ArrayHotelPresenter());

        return $service->execute($request, $presenter)->read();
    }

    public static function getAliases()
    {
        return [
            'resolve' => 'HotelsResolver'
        ];
    }
}
