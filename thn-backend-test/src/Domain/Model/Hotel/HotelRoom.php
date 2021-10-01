<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Hotel;

use Thn\BackendTest\Domain\Model\Room\RoomId;

class HotelRoom
{
    /** @var HotelId */
    private $hotelId;

    /** @var RoomId */
    private $roomId;

    /**
     * UserClient constructor.
     */
    public function __construct(
        HotelId $hotelId,
        RoomId $roomId
    ) {
        $this->hotelId = $hotelId;
        $this->roomId = $roomId;
    }

    public function hotelId(): HotelId
    {
        return $this->hotelId;
    }

    public function roomId(): RoomId
    {
        return $this->roomId;
    }
}
