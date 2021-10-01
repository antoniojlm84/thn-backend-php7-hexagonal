<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Unit\Domain\Model\Room;

use Faker\Factory;
use Thn\BackendTest\Domain\Model\Room\RoomFloor;

final class RoomFloorMother
{
    public static function create(string $floor): RoomFloor
    {
        return new RoomFloor($floor);
    }

    public static function random(): RoomFloor
    {
        $faker = Factory::create();

        return self::create('Floor ' . $faker->numberBetween(0,5));
    }
}
