<?php

declare(strict_types=1);

namespace HotelPlex\Domain\Entity\Hotel;

use HotelPlex\Domain\Event\DomainEventPublisher;
use HotelPlex\Domain\Event\Hotel\HotelRegistered;
use HotelPlex\Domain\Event\Hotel\HotelUpdatedInfo;

class Hotel
{
    /**
     * @var HotelId
     */
    private $uuid;
    /**
     * @var HotelName
     */
    private $name;
    /**
     * @var HotelAddress
     */
    private $address;
    /**
     * @var HotelPhone
     */
    private $phone;
    /**
     * @var HotelEmail
     */
    private $email;
    /**
     * @var HotelLift
     */
    private $lift;
    /**
     * @var HotelWifi
     */
    private $wifi;
    /**
     * @var HotelAccessibility
     */
    private $accessibility;
    /**
     * @var HotelParking
     */
    private $parking;
    /**
     * @var HotelKitchen
     */
    private $kitchen;
    /**
     * @var HotelPets
     */
    private $pets;
    /**
     * @var HotelPaymentMethods
     */
    private $paymentMethods;
    /**
     * @var HotelLogo
     */
    private $logo;
    /**
     * @var HotelImages
     */
    private $images;

    public function __construct(
        HotelId $uuid,
        HotelName $name,
        HotelAddress $address,
        HotelPhone $phone,
        HotelEmail $email,
        HotelLift $lift,
        HotelWifi $wifi,
        HotelAccessibility $accessibility,
        HotelParking $parking,
        HotelKitchen $kitchen,
        HotelPets $pets,
        HotelPaymentMethods $paymentMethods,
        HotelLogo $logo,
        HotelImages $images
    )
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
        $this->lift = $lift;
        $this->wifi = $wifi;
        $this->accessibility = $accessibility;
        $this->parking = $parking;
        $this->kitchen = $kitchen;
        $this->pets = $pets;
        $this->paymentMethods = $paymentMethods;
        $this->logo = $logo;
        $this->images = $images;
    }

    /**
     * @param HotelName $name
     * @param HotelAddress $address
     * @param HotelPhone $phone
     * @param HotelEmail $email
     * @param HotelLift $lift
     * @param HotelWifi $wifi
     * @param HotelAccessibility $accessibility
     * @param HotelParking $parking
     * @param HotelKitchen $kitchen
     * @param HotelPets $pets
     * @return Hotel
     */
    public static function register(
        HotelName $name,
        HotelAddress $address,
        HotelPhone $phone,
        HotelEmail $email,
        HotelLift $lift,
        HotelWifi $wifi,
        HotelAccessibility $accessibility,
        HotelParking $parking,
        HotelKitchen $kitchen,
        HotelPets $pets
    ): Hotel
    {
        $hotel = new self(
            new HotelId(),
            $name,
            $address,
            $phone,
            $email,
            $lift,
            $wifi,
            $accessibility,
            $parking,
            $kitchen,
            $pets,
            new HotelPaymentMethods([]),
            new HotelLogo(null),
            new HotelImages([])
        );

        DomainEventPublisher::instance()->publish(
            new HotelRegistered(
                $hotel->uuid()->value(),
                $hotel->name()->value(),
                $hotel->address()->value(),
                $hotel->phone()->value(),
                $hotel->email()->value(),
                $hotel->lift()->value(),
                $hotel->wifi()->value(),
                $hotel->accessibility()->value(),
                $hotel->parking()->value(),
                $hotel->kitchen()->value(),
                $hotel->pets()->value()
            )
        );

        return $hotel;
    }

    /**
     * @param HotelName $name
     * @param HotelAddress $address
     * @param HotelPhone $phone
     * @param HotelEmail $email
     * @param HotelLift $lift
     * @param HotelWifi $wifi
     * @param HotelAccessibility $accessibility
     * @param HotelParking $parking
     * @param HotelKitchen $kitchen
     * @param HotelPets $pets
     * @param HotelPaymentMethods $paymentMethods
     * @param HotelLogo $logo
     * @param HotelImages $images
     */
    public function updateInfo(
        HotelName $name,
        HotelAddress $address,
        HotelPhone $phone,
        HotelEmail $email,
        HotelLift $lift,
        HotelWifi $wifi,
        HotelAccessibility $accessibility,
        HotelParking $parking,
        HotelKitchen $kitchen,
        HotelPets $pets,
        HotelPaymentMethods $paymentMethods,
        HotelLogo $logo,
        HotelImages $images
    )
    {
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
        $this->lift = $lift;
        $this->wifi = $wifi;
        $this->accessibility = $accessibility;
        $this->parking = $parking;
        $this->kitchen = $kitchen;
        $this->pets = $pets;
        $this->paymentMethods = $paymentMethods;
        $this->logo = $logo;
        $this->images = $images;

        DomainEventPublisher::instance()->publish(
            new HotelUpdatedInfo(
                $this->uuid()->value(),
                $this->name()->value(),
                $this->address()->value(),
                $this->phone()->value(),
                $this->email()->value(),
                $this->lift()->value(),
                $this->wifi()->value(),
                $this->accessibility()->value(),
                $this->parking()->value(),
                $this->kitchen()->value(),
                $this->pets()->value(),
                $this->paymentMethods()->value(),
                $this->logo()->value(),
                $this->images()->value()
            )
        );
    }

    /**
     * @return HotelId
     */
    public function uuid(): HotelId
    {
        return $this->uuid;
    }

    /**
     * @return HotelName
     */
    public function name(): HotelName
    {
        return $this->name;
    }

    /**
     * @return HotelAddress
     */
    public function address(): HotelAddress
    {
        return $this->address;
    }

    /**
     * @return HotelPhone
     */
    public function phone(): HotelPhone
    {
        return $this->phone;
    }

    /**
     * @return HotelEmail
     */
    public function email(): HotelEmail
    {
        return $this->email;
    }

    /**
     * @return HotelLift
     */
    public function lift(): HotelLift
    {
        return $this->lift;
    }

    /**
     * @return HotelWifi
     */
    public function wifi(): HotelWifi
    {
        return $this->wifi;
    }

    /**
     * @return HotelAccessibility
     */
    public function accessibility(): HotelAccessibility
    {
        return $this->accessibility;
    }

    /**
     * @return HotelParking
     */
    public function parking(): HotelParking
    {
        return $this->parking;
    }

    /**
     * @return HotelKitchen
     */
    public function kitchen(): HotelKitchen
    {
        return $this->kitchen;
    }

    /**
     * @return HotelPets
     */
    public function pets(): HotelPets
    {
        return $this->pets;
    }

    /**
     * @return HotelPaymentMethods
     */
    public function paymentMethods(): HotelPaymentMethods
    {
        return $this->paymentMethods;
    }

    /**
     * @return HotelLogo
     */
    public function logo(): HotelLogo
    {
        return $this->logo;
    }

    /**
     * @return HotelImages
     */
    public function images(): HotelImages
    {
        return $this->images;
    }
}
