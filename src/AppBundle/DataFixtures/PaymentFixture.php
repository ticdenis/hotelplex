<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\DBAL\Connection;
use HotelPlex\Domain\Entity\Payment\PaymentId;

class PaymentFixture
{
    /**
     * @param Connection $connection
     */
    public function load(Connection $connection)
    {
        $values['uuid'] = (new PaymentId())->value();
        $values['payment_method'] = 'VISA';
        $values['currency'] = 1; // EUR
        $values['price'] = 45.95;
        $values['created_at'] = date('Y-m-d H:i:s');

        $queryBuilder = $connection->createQueryBuilder()->insert('payments');
        $index = 0;
        foreach ($values as $key => $value) {
            $queryBuilder->setValue($key, '?');
            $queryBuilder->setParameter($index++, is_bool($value) ? +$value : $value);
        }
        $queryBuilder->execute();
    }
}
