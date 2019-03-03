<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\DBAL\Connection;
use HotelPlex\Infrastructure\Presenter\Hotel\ArrayRoomPresenter;
use HotelPlex\Tests\Infrastructure\Domain\Factory\FakerRoomFactory;

class RoomFixture
{
    /**
     * @param Connection $connection
     */
    public function load(Connection $connection)
    {
        $presenter = new ArrayRoomPresenter();
        $room = FakerRoomFactory::create();

        $values = $presenter->write($room)->read();
        $values['individual_price'] = $values['individualPrice'];
        $values['individual_beds'] = json_encode($values['individualBeds'], JSON_FORCE_OBJECT);
        unset($values['individualPrice']);
        $values['double_price'] = $values['doublePrice'];
        $values['double_beds'] = json_encode($values['doubleBeds'], JSON_FORCE_OBJECT);
        unset($values['doublePrice']);
        $values['currency_id'] = 1; // EUR
        unset($values['currency']);
        unset($values['facilities']);
        unset($values['individualBeds']);
        unset($values['doubleBeds']);
        unset($values['images']);

        $queryBuilder = $connection->createQueryBuilder()->insert('rooms');
        $index = 0;
        foreach ($values as $key => $value) {
            $queryBuilder->setValue($key, '?');
            $queryBuilder->setParameter($index++, is_bool($value) ? +$value : $value);
        }
        $queryBuilder->execute();
    }
}
