<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\DBAL\Connection;
use HotelPlex\Domain\Entity\Provider\ProviderId;
use HotelPlex\Domain\Entity\Provider\ProviderPassword;

class ProviderFixture
{
    /**
     * @param Connection $connection
     */
    public function load(Connection $connection)
    {
        $values['uuid'] = (new ProviderId())->value();
        $values['username'] = 'proviname';
        $values['email'] = 'provider@hotelplex.com';
        $values['password'] = (new ProviderPassword('secret'))->value();
        $values['created_at'] = date('Y-m-d H:i:s');
        $values['updated_at'] = date('Y-m-d H:i:s');

        $queryBuilder = $connection->createQueryBuilder()->insert('providers');
        $index = 0;
        foreach ($values as $key => $value) {
            $queryBuilder->setValue($key, '?');
            $queryBuilder->setParameter($index++, is_bool($value) ? +$value : $value);
        }
        $queryBuilder->execute();
    }
}
