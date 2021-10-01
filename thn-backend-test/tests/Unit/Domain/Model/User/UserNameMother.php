<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Unit\Domain\Model\User;

use Faker\Factory;
use Thn\BackendTest\Domain\Model\User\UserName;

final class UserNameMother
{
    public static function create(string $name): UserName
    {
        return new UserName($name);
    }

    public static function random(): UserName
    {
        $faker = Factory::create();

        return self::create($faker->name);
    }
}
