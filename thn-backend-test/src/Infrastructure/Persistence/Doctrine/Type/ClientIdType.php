<?php

declare(strict_types=1);

namespace Thn\BackendTest\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Thn\BackendTest\Domain\Model\Client\ClientId;

class ClientIdType extends UuidType
{
    public const NAME = 'client_id';

    public function getName(): string
    {
        return static::NAME;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return true === is_null($value) ? null : $value->value();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return null === $value ? null : new ClientId($value);
    }
}
