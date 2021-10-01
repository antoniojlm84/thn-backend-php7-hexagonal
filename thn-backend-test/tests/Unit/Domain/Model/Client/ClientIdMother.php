<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Unit\Domain\Model\Client;

use Thn\BackendTest\Domain\Model\Client\ClientId;

final class ClientIdMother
{
    public static function create(string $name): ClientId
    {
        return new ClientId($name);
    }

    public static function random(): ClientId
    {
        return self::create(ClientId::random()->value());
    }
}
