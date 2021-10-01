<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Unit\Domain\Model\Hotel;

use Faker\Factory;
use Thn\BackendTest\Domain\Model\Hotel\HotelPhone;

final class HotelPhoneMother
{
    public static function create(string $mother): HotelPhone
    {
        return new HotelPhone($mother);
    }

    public static function random(): HotelPhone
    {
        $faker = Factory::create();

        return self::create($faker->phoneNumber);
    }
}
