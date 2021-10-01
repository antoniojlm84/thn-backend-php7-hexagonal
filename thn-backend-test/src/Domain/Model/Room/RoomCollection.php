<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Room;

use Thn\BackendTest\Domain\Collection\AbstractEntityCollection;

class RoomCollection extends AbstractEntityCollection
{
    public function addRoom(Room $room): void
    {
        $this->addItem($room);
    }

    public function addRooms(iterable $rooms): void
    {
        foreach ($rooms as $room) {
            $this->addRoom($room);
        }
    }
}
