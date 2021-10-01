<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Client;

use Thn\BackendTest\Domain\Model\Country\CountryIso;
use Thn\BackendTest\Domain\Model\DeleteTrait;
use Thn\BackendTest\Domain\Model\Email\Email;
use Thn\BackendTest\Domain\Model\Hotel\HotelRoomCollection;
use Thn\BackendTest\Domain\Model\Room\RoomCollection;
use Thn\BackendTest\Domain\Model\TimeAwareTrait;

class Client
{
    use DeleteTrait;
    use TimeAwareTrait;

    /** @var ClientId */
    private $id;

    /** @var Email */
    private $email;

    /** @var ClientName */
    private $name;

    /** @var CountryIso */
    private $countryIso;

    /** @var null|ClientRoomCollection */
    private $clientRoomCollection;

    /** @var RoomCollection */
    private $rooms;

    public function id(): ClientId
    {
        return $this->id;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function name(): ClientName
    {
        return $this->name;
    }

    public function countryIso(): CountryIso
    {
        return $this->countryIso;
    }

    public function clientRoomCollection(): ?ClientRoomCollection
    {
        return $this->clientRoomCollection;
    }

    public function rooms(): ?RoomCollection
    {
        return $this->rooms;
    }
}
