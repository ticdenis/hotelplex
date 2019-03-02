<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\DBAL\Connection;
use HotelPlex\Infrastructure\Presenter\Hotel\ArrayHotelPresenter;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerHotelFactory;

class HotelFixture
{
    /**
     * @param Connection $connection
     */
    public function load(Connection $connection)
    {
        $presenter = new ArrayHotelPresenter();
        $hotel = FakerHotelFactory::create();

        $values = $presenter->write($hotel)->read();
        unset($values['paymentMethods']);
        unset($values['images']);
        $values['created_at'] = date('Y-m-d H:i:s');
        $values['updated_at'] = date('Y-m-d H:i:s');

        $queryBuilder = $connection->createQueryBuilder()->insert('hotels');
        $index = 0;
        foreach ($values as $key => $value) {
            $queryBuilder->setValue($key, '?');
            $queryBuilder->setParameter($index++, is_bool($value) ? +$value : $value);
        }
        $queryBuilder->execute();
    }
}
