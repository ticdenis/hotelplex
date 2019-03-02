<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Entity\Hotel\Room;

final class Room
{
    /**
     * @var RoomId
     */
    private $uuid;
    /**
     * @var RoomFacilities
     */
    private $facilities;
    /**
     * @var RoomIndividualPrice
     */
    private $individualPrice;
    /**
     * @var RoomIndividualBeds
     */
    private $individualBeds;
    /**
     * @var RoomDoublePrice
     */
    private $doublePrice;
    /**
     * @var RoomDoubleBeds
     */
    private $doubleBeds;
    /**
     * @var RoomImages
     */
    private $images;

    /**
     * @param RoomId $uuid
     * @param RoomFacilities $facilities
     * @param RoomIndividualPrice $individualPrice
     * @param RoomIndividualBeds $individualBeds
     * @param RoomDoublePrice $doublePrice
     * @param RoomDoubleBeds $doubleBeds
     * @param RoomImages $images
     */
    public function __construct(
        RoomId $uuid,
        RoomFacilities $facilities,
        RoomIndividualPrice $individualPrice,
        RoomIndividualBeds $individualBeds,
        RoomDoublePrice $doublePrice,
        RoomDoubleBeds $doubleBeds,
        RoomImages $images
    )
    {
        $this->uuid = $uuid;
        $this->facilities = $facilities;
        $this->individualPrice = $individualPrice;
        $this->individualBeds = $individualBeds;
        $this->doublePrice = $doublePrice;
        $this->doubleBeds = $doubleBeds;
        $this->images = $images;
    }

    /**
     * @return RoomId
     */
    public function uuid(): RoomId
    {
        return $this->uuid;
    }

    /**
     * @return RoomFacilities
     */
    public function facilities(): RoomFacilities
    {
        return $this->facilities;
    }

    /**
     * @return RoomIndividualPrice
     */
    public function individualPrice(): RoomIndividualPrice
    {
        return $this->individualPrice;
    }

    /**
     * @return RoomIndividualBeds
     */
    public function individualBeds(): RoomIndividualBeds
    {
        return $this->individualBeds;
    }

    /**
     * @return RoomDoublePrice
     */
    public function doublePrice(): RoomDoublePrice
    {
        return $this->doublePrice;
    }

    /**
     * @return RoomDoubleBeds
     */
    public function doubleBeds(): RoomDoubleBeds
    {
        return $this->doubleBeds;
    }

    /**
     * @return RoomImages
     */
    public function images(): RoomImages
    {
        return $this->images;
    }
}
