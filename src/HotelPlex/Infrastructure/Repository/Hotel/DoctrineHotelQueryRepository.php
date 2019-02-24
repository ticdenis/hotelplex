<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Repository\Hotel;

use Doctrine\ORM\EntityManagerInterface;
use HotelPlex\Application\Mapper\Hotel\HotelMapper;
use HotelPlex\Domain\Entity\Hotel\Hotel;
use HotelPlex\Domain\Exception\Hotel\HotelNotFoundException;
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
     * @return Hotel
     * @throws HotelNotFoundException
     */
    public function ofIdOrFail(UuidValueObject $uuid): Hotel
    {
        $item = $this->connection->createQueryBuilder()
            ->select('*')
            ->from($this->hotelsTable)
            ->where('uuid = :uuid')
            ->setParameter('uuid', $uuid->value())
            ->setMaxResults(1)
            ->execute()
            ->fetch();

        if (!$item) {
            throw HotelNotFoundException::withUUID($uuid->value());
        }

        return $this->hotelMapper->item($item);
    }
}
