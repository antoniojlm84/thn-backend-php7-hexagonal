<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Unit\Domain\Model\User;

use Faker\Factory;
use Thn\BackendTest\Domain\Model\User\UserPassword;

final class UserPasswordMother
{
    public static function create(string $password): UserPassword
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        return new UserPassword($password);
    }

    public static function random(): UserPassword
    {
        $password = Factory::create()->password;

        return self::create(
            password_hash($password, PASSWORD_DEFAULT)
        );
    }
}
