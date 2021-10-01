<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Hotel;

use Thn\BackendTest\Domain\Model\Country\CountryIso;
use Thn\BackendTest\Domain\Model\DeleteTrait;
use Thn\BackendTest\Domain\Model\Email\Email;
use Thn\BackendTest\Domain\Model\Room\RoomCollection;
use Thn\BackendTest\Domain\Model\TimeAwareTrait;

class Hotel
{
    use DeleteTrait;
    use TimeAwareTrait;

    /** @var HotelId */
    private $id;

    /** @var HotelName */
    private $name;

    /** @var HotelCity */
    private $city;

    /** @var CountryIso */
    private $country;

    /** @var HotelPhone */
    private $phone;

    /** @var Email */
    private $email;

    /** @var null|HotelRoomCollection */
    private $hotelRoomCollection;

    /** @var RoomCollection */
    private $rooms;

    public function id(): HotelId
    {
        return $this->id;
    }

    public function country(): CountryIso
    {
        return $this->country;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function name(): HotelName
    {
        return $this->name;
    }

    public function city(): HotelCity
    {
        return $this->city;
    }

    public function phone(): HotelPhone
    {
        return $this->phone;
    }

    public function hotelRoomCollection(): ?HotelRoomCollection
    {
        return $this->hotelRoomCollection;
    }

    public function rooms(): ?RoomCollection
    {
        return $this->rooms;
    }
}
