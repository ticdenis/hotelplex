<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Repository\Hotel;

use Doctrine\ORM\EntityManagerInterface;
use HotelPlex\Application\Mapper\Hotel\HotelMapper;
use HotelPlex\Domain\Entity\Hotel\Hotel;
use HotelPlex\Domain\Repository\Hotel\HotelQueryRepository;
use HotelPlex\Domain\ValueObject\UuidValueObject;
use HotelPlex\Infrastructure\Repository\DoctrineBaseRepository;

final class DoctrineHotelQueryRepository extends DoctrineBaseRepository implements HotelQueryRepository
{
    /**
     * @var string
     */
    private $hotelsTable = 'hotels';

    /**
     * @var HotelMapper
     */
    private $hotelMapper;

    /**
     * @param EntityManagerInterface $entityManager
     * @param HotelMapper $paymentMapper
     */
    public function __construct(EntityManagerInterface $entityManager, HotelMapper $paymentMapper)
    {
        parent::__construct($entityManager);
        $this->hotelMapper = $paymentMapper;
    }

    /**
     * @return Hotel[]
     */
    public function all(): array
    {
        $items = $this->connection->createQueryBuilder()
            ->select('*')
            ->from($this->hotelsTable)
            ->execute()
            ->fetchAll();

        return $this->hotelMapper->items($items);
    }

    /**
     * @param UuidValueObject $uuid
     * @return Hotel|null
     */
    public function ofId(UuidValueObject $uuid): ?Hotel
    {
        $item = $this->connection->createQueryBuilder()
            ->select('*')
            ->from($this->hotelsTable)
            ->where('uuid = :uuid')
            ->setParameter('uuid', $uuid->value())
            ->setMaxResults(1)
            ->execute()
            ->fetch();

        return $item ? $this->hotelMapper->item($item) : null;
    }
}
