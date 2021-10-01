<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Unit\Domain\Model\Room;

use Thn\BackendTest\Domain\Model\Room\RoomId;

final class RoomIdMother
{
    public static function create(string $name): RoomId
    {
        return new RoomId($name);
    }

    public static function random(): RoomId
    {
        return self::create(RoomId::random()->value());
    }
}
