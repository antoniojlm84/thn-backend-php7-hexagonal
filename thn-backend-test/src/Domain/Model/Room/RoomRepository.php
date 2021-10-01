<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Room;

interface RoomRepository
{
    public function byId(RoomId $roomId): ?Room;

    public function save(Room $room): void;

    public function count(): int;
}
