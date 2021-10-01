<?php

declare(strict_types=1);

namespace Thn\BackendTest\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Thn\BackendTest\Domain\Model\Room\RoomId;

class RoomIdType extends UuidType
{
    public const NAME = 'room_id';

    public function getName(): string
    {
        return static::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new RoomId($value);
    }
}
