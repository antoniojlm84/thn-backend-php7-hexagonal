<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Unit\Domain\Model\Hotel;

use ReflectionClass;
use Thn\BackendTest\Domain\Model\Country\CountryIso;
use Thn\BackendTest\Domain\Model\Email\Email;
use Thn\BackendTest\Domain\Model\Hotel\Hotel;
use Thn\BackendTest\Domain\Model\Hotel\HotelCity;
use Thn\BackendTest\Domain\Model\Hotel\HotelId;
use Thn\BackendTest\Domain\Model\Hotel\HotelName;
use Thn\BackendTest\Domain\Model\Hotel\HotelPhone;
use Thn\BackendTest\Tests\Unit\Domain\Model\Mother;

final class HotelMother extends Mother
{
    public static function withId(HotelId $id): Hotel
    {
        $reflectionClass = new ReflectionClass(Hotel::class);

        /** @var Hotel $Hotel */
        $Hotel = $reflectionClass->newInstanceWithoutConstructor();

        $data = [
            'id' => $id,
            'name' => HotelNameMother::random(),
            'email' => HotelEmailMother::random(),
            'city' => HotelCityMother::random(),
            'phone' => HotelPhoneMother::random(),
            'country' => CountryIso::random(),
            'deleted' => false,
            'createdAt' => new \DateTimeImmutable('now'),
            'updatedAt' => new \DateTimeImmutable('now'),
            'countryIso' => new CountryIso(CountryIso::random())
        ];

        self::setProperties($reflectionClass, $Hotel, $data);

        return $Hotel;
    }

    public static function random(): Hotel
    {
        return self::withId(HotelId::random());
    }

    public static function withParameters(
        HotelId $id,
        HotelName $name,
        Email $email,
        HotelPhone $phone,
        HotelCity $city,
        CountryIso $countryIso
    ): Hotel {
        $reflectionClass = new ReflectionClass(Hotel::class);

        /** @var Hotel $Hotel */
        $Hotel = $reflectionClass->newInstanceWithoutConstructor();

        $data = [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'city' => $city,
            'phone' => $phone,
            'country' => $countryIso,
            'deleted' => false,
            'createdAt' => new \DateTimeImmutable('now'),
            'updatedAt' => new \DateTimeImmutable('now')
        ];

        self::setProperties($reflectionClass, $Hotel, $data);

        return $Hotel;
    }
}
