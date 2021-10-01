<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Unit\Domain\Model\Hotel;

use Faker\Factory;
use Thn\BackendTest\Domain\Model\Hotel\HotelName;

final class HotelNameMother
{
    public static function create(string $name): HotelName
    {
        return new HotelName($name);
    }

    public static function random(): HotelName
    {
        $faker = Factory::create();

        return self::create($faker->name);
    }
}
