<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Unit\Domain\Model\User;

use Thn\BackendTest\Domain\Model\User\UserId;

class UserIdMother
{
    public static function create(string $userId): UserId
    {
        return new UserId($userId);
    }

    public static function random(): UserId
    {
        return self::create(UserId::random()->value());
    }
}
