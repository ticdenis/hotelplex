<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\DBAL\Connection;
use HotelPlex\Domain\Entity\User\UserHotelsException;
use HotelPlex\Domain\Entity\User\UserId;
use HotelPlex\Domain\Entity\User\UserPassword;

class UserFixture
{
    /**
     * @param Connection $connection
     */
    public function load(Connection $connection)
    {
        $hotel = $connection->createQueryBuilder()
            ->select('uuid')
            ->from('hotels')
            ->setMaxResults(1)
            ->execute()
            ->fetch();

        $values['uuid'] = (new UserId())->value();
        $values['username'] = 'admin';
        $values['email'] = 'admin@hotelplex.com';
        $values['password'] = (new UserPassword('secret'))->value();
        $values['hotels'] = $hotel['uuid'];
        $values['created_at'] = date('Y-m-d H:i:s');
        $values['updated_at'] = date('Y-m-d H:i:s');

        $queryBuilder = $connection->createQueryBuilder()->insert('users');
        $index = 0;
        foreach ($values as $key => $value) {
            $queryBuilder->setValue($key, '?');
            $queryBuilder->setParameter($index++, is_bool($value) ? +$value : $value);
        }
        $queryBuilder->execute();
    }
}
