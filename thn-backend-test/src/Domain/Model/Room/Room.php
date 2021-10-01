<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Room;

use Thn\BackendTest\Domain\Model\Client\ClientId;
use Thn\BackendTest\Domain\Model\DeleteTrait;
use Thn\BackendTest\Domain\Model\Hotel\HotelId;
use Thn\BackendTest\Domain\Model\TimeAwareTrait;

class Room
{
    use DeleteTrait;
    use TimeAwareTrait;

    /** @var RoomId */
    private $id;

    /** @var RoomFloor */
    private $floor;

    /** @var RoomNumber */
    private $roomNumber;

    /** @var RoomDescription */
    private $description;

    public function id(): RoomId
    {
        return $this->id;
    }

    public function description(): RoomDescription
    {
        return $this->description;
    }

    public function floor(): RoomFloor
    {
        return $this->floor;
    }

    public function roomNumber(): RoomNumber
    {
        return $this->roomNumber;
    }
}
