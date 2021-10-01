<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Unit\Domain\Model\User;

use Faker\Factory;
use Thn\BackendTest\Domain\Model\Email\Email;

final class UserEmailMother
{
    public static function create(string $name): Email
    {
        return new Email($name);
    }

    public static function random(): Email
    {
        $faker = Factory::create();

        return self::create($faker->email);
    }
}
