<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Unit\Domain\Model\Room;

use Faker\Factory;
use Thn\BackendTest\Domain\Model\Room\RoomNumber;

final class RoomNumberMother
{
    public static function create(string $number): RoomNumber
    {
        return new RoomNumber($number);
    }

    public static function random(): RoomNumber
    {
        $faker = Factory::create();

        return self::create('Room ' . $faker->numberBetween(0,100));
    }
}
