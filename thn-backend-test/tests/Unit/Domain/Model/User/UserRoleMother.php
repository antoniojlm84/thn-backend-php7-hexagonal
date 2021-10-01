<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Unit\Domain\Model\User;

use Thn\BackendTest\Domain\Model\Role\Role as UserRole;

final class UserRoleMother
{
    public static function create(string $name): UserRole
    {
        return new UserRole($name);
    }

    public static function random(): UserRole
    {
        $index = rand(0, 1);

        return self::create(UserRole::$roles[$index]);
    }
}
