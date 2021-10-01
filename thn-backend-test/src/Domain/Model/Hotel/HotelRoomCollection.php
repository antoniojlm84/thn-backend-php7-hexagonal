<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Hotel;

use Thn\BackendTest\Domain\Collection\AbstractCollection;

class HotelRoomCollection extends AbstractCollection
{
    public function addHotelRoom(HotelRoom $hotelRoom)
    {
        $this->addItem($hotelRoom);
    }

    public function addHotelRooms(iterable $hotelRooms)
    {
        foreach ($hotelRooms as $hotelRoom) {
            $this->addHotelRoom($hotelRoom);
        }
    }

    protected function calculateHash($item): string
    {
        return md5($item->hotelId()->value().$item->roomId()->value());
    }
}
