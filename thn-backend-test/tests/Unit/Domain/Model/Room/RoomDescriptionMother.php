<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Unit\Domain\Model\Room;

use Faker\Factory;
use Thn\BackendTest\Domain\Model\Room\RoomDescription;
use Thn\BackendTest\Domain\Model\Room\RoomNumber;

final class RoomDescriptionMother
{
    public static function create(string $description): RoomDescription
    {
        return new RoomDescription($description);
    }

    public static function random(): RoomDescription
    {
        $faker = Factory::create();

        return self::create($faker->text);
    }
}
