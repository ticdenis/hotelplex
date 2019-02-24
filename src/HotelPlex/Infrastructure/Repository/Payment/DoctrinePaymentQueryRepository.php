<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Repository\Payment;

use Doctrine\ORM\EntityManagerInterface;
use HotelPlex\Application\Mapper\Payment\PaymentMapper;
use HotelPlex\Domain\Entity\Payment\Payment;
use HotelPlex\Domain\Repository\Payment\PaymentQueryRepository;
use HotelPlex\Infrastructure\Repository\DoctrineBaseRepository;

final class DoctrinePaymentQueryRepository extends DoctrineBaseRepository implements PaymentQueryRepository
{
    /**
     * @var string
     */
    private $paymentsTable = 'payments';

    /**
     * @var PaymentMapper
     */
    private $paymentMapper;

    public function __construct(EntityManagerInterface $entityManager, PaymentMapper $paymentMapper)
    {
        parent::__construct($entityManager);
        $this->paymentMapper = $paymentMapper;
    }

    /**
     * @return Payment[]
     */
    public function all(): array
    {
        $items = $this->connection->createQueryBuilder()
            ->select('*')
            ->from($this->paymentsTable)
            ->execute()
            ->fetchAll();

        return $this->paymentMapper->items($items);
    }
}
