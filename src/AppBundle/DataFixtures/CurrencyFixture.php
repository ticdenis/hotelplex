<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\DBAL\Connection;

class CurrencyFixture
{
    /**
     * @param Connection $connection
     */
    public function load(Connection $connection)
    {
        $values['id'] = 1;
        $values['code'] = 'EUR';

        $queryBuilder = $connection->createQueryBuilder()->insert('currencies');
        $index = 0;
        foreach ($values as $key => $value) {
            $queryBuilder->setValue($key, '?');
            $queryBuilder->setParameter($index++, is_bool($value) ? +$value : $value);
        }
        $queryBuilder->execute();

        $values['id'] = 2;
        $values['code'] = 'USD';

        $queryBuilder = $connection->createQueryBuilder()->insert('currencies');
        $index = 0;
        foreach ($values as $key => $value) {
            $queryBuilder->setValue($key, '?');
            $queryBuilder->setParameter($index++, is_bool($value) ? +$value : $value);
        }
        $queryBuilder->execute();
    }
}
