<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Unit\Domain\Model\Room;

use ReflectionClass;
use Thn\BackendTest\Domain\Model\Client\ClientId;
use Thn\BackendTest\Domain\Model\Country\CountryIso;
use Thn\BackendTest\Domain\Model\Hotel\HotelId;
use Thn\BackendTest\Domain\Model\Room\Room;
use Thn\BackendTest\Domain\Model\Room\RoomDescription;
use Thn\BackendTest\Domain\Model\Room\RoomFloor;
use Thn\BackendTest\Domain\Model\Room\RoomId;
use Thn\BackendTest\Domain\Model\Room\RoomNumber;
use Thn\BackendTest\Tests\Unit\Domain\Model\Mother;

final class RoomMother extends Mother
{
    public static function withId(RoomId $id): Room
    {
        $reflectionClass = new ReflectionClass(Room::class);

        /** @var Room $Room */
        $Room = $reflectionClass->newInstanceWithoutConstructor();

        $data = [
            'id' => $id,
            'roomNumber' => RoomNumberMother::random(),
            'floor' => RoomFloorMother::random(),
            'description' => RoomDescriptionMother::random(),
            'deleted' => false,
            'createdAt' => new \DateTimeImmutable('now'),
            'updatedAt' => new \DateTimeImmutable('now'),
            'countryIso' => new CountryIso(CountryIso::random())
        ];

        self::setProperties($reflectionClass, $Room, $data);

        return $Room;
    }

    public static function random(): Room
    {
        return self::withId(RoomId::random());
    }

    public static function withParameters(
        RoomId $id,
        RoomNumber $roomNumber,
        RoomFloor $floor,
        RoomDescription $description
    ): Room {
        $reflectionClass = new ReflectionClass(Room::class);

        /** @var Room $Room */
        $Room = $reflectionClass->newInstanceWithoutConstructor();

        $data = [
            'id' => $id,
            'roomNumber' => $roomNumber,
            'floor' => $floor,
            'description' => $description,
            'deleted' => false,
            'createdAt' => new \DateTimeImmutable('now'),
            'updatedAt' => new \DateTimeImmutable('now')
        ];

        self::setProperties($reflectionClass, $Room, $data);

        return $Room;
    }
}
