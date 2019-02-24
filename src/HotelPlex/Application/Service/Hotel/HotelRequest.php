<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service\Hotel;

use HotelPlex\Application\Service\Request;
use HotelPlex\Domain\ValueObject\UuidValueObject;

class HotelRequest implements Request
{
    /**
     * @var UuidValueObject
     */
    private $uuid;

    /**
     * @param string $uuid
     */
    public function __construct(string $uuid)
    {
        $this->uuid = new UuidValueObject($uuid);
    }

    /**
     * @return UuidValueObject
     */
    public function uuid(): UuidValueObject
    {
        return $this->uuid;
    }
}
