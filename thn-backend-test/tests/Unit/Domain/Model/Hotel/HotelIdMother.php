<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Unit\Domain\Model\Hotel;

use Thn\BackendTest\Domain\Model\Hotel\HotelId;

final class HotelIdMother
{
    public static function create(string $name): HotelId
    {
        return new HotelId($name);
    }

    public static function random(): HotelId
    {
        return self::create(HotelId::random()->value());
    }
}
