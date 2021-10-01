<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Unit\Domain\Model\Client;

use Faker\Factory;
use Thn\BackendTest\Domain\Model\Client\ClientName;

final class ClientNameMother
{
    public static function create(string $name): ClientName
    {
        return new ClientName($name);
    }

    public static function random(): ClientName
    {
        $faker = Factory::create();

        return self::create($faker->name);
    }
}
