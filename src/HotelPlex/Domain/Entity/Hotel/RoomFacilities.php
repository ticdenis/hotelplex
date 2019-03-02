<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Entity\Hotel;

final class RoomFacilities
{
    /**
     * @var RoomTv
     */
    private $tv;
    /**
     * @var RoomHeating
     */
    private $heating;
    /**
     * @var RoomAirConditioning
     */
    private $airConditioning;
    /**
     * @var RoomWc
     */
    private $roomWc;
    /**
     * @var RoomShower
     */
    private $shower;
    /**
     * @var RoomWardrobe
     */
    private $wardrobe;
    /**
     * @var RoomLocker
     */
    private $locker;
    /**
     * @var RoomAccessibility
     */
    private $accessibility;

    public function __construct(
        RoomTv $tv,
        RoomHeating $heating,
        RoomAirConditioning $airConditioning,
        RoomWc $roomWc,
        RoomShower $shower,
        RoomWardrobe $wardrobe,
        RoomLocker $locker,
        RoomAccessibility $accessibility
    )
    {
        $this->tv = $tv;
        $this->heating = $heating;
        $this->airConditioning = $airConditioning;
        $this->roomWc = $roomWc;
        $this->shower = $shower;
        $this->wardrobe = $wardrobe;
        $this->locker = $locker;
        $this->accessibility = $accessibility;
    }

    /**
     * @return RoomTv
     */
    public function tv(): RoomTv
    {
        return $this->tv;
    }

    /**
     * @return RoomHeating
     */
    public function heating(): RoomHeating
    {
        return $this->heating;
    }

    /**
     * @return RoomAirConditioning
     */
    public function airConditioning(): RoomAirConditioning
    {
        return $this->airConditioning;
    }

    /**
     * @return RoomWc
     */
    public function roomWc(): RoomWc
    {
        return $this->roomWc;
    }

    /**
     * @return RoomShower
     */
    public function shower(): RoomShower
    {
        return $this->shower;
    }

    /**
     * @return RoomWardrobe
     */
    public function wardrobe(): RoomWardrobe
    {
        return $this->wardrobe;
    }

    /**
     * @return RoomLocker
     */
    public function locker(): RoomLocker
    {
        return $this->locker;
    }

    /**
     * @return RoomAccessibility
     */
    public function accessibility(): RoomAccessibility
    {
        return $this->accessibility;
    }
}
