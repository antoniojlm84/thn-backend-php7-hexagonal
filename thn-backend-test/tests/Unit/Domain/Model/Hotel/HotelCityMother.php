<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Unit\Domain\Model\Hotel;

use Faker\Factory;
use Thn\BackendTest\Domain\Model\Hotel\HotelCity;

final class HotelCityMother
{
    public static function create(string $city): HotelCity
    {
        return new HotelCity($city);
    }

    public static function random(): HotelCity
    {
        $faker = Factory::create();

        return self::create($faker->city);
    }
}
