<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Unit\Domain\Model\User;

use Thn\BackendTest\Domain\Model\User\UserName;
use Thn\BackendTest\Domain\Model\User\UserRole;
use Thn\BackendTest\Domain\Model\Email\Email;
use Thn\BackendTest\Domain\Model\User\UserId;
use Thn\BackendTest\Domain\Model\User\User;
use Thn\BackendTest\Domain\Model\User\UserPassword;
use Thn\BackendTest\Tests\Unit\Domain\Model\Mother;

final class UserMother extends Mother
{
    public static function withId(UserId $id): User
    {
        $reflectionClass = new \ReflectionClass(User::class);

        /** @var User $user */
        $user = $reflectionClass->newInstanceWithoutConstructor();

        $data = [
            'id' => $id,
            'name' => UserNameMother::random(),
            'email' => UserEmailMother::random(),
            'password' => UserPasswordMother::random(),
            'role' => UserRoleMother::random(),
            'deleted' => false,
            'createdAt' => new \DateTimeImmutable('now'),
            'updatedAt' => new \DateTimeImmutable('now'),
        ];

        self::setProperties($reflectionClass, $user, $data);

        return $user;
    }

    public static function random(): User
    {
        return self::withId(new UserId(UserId::random()->value()));
    }

    public static function withParameters(
        UserId $id,
        UserName $name,
        Email $email,
        UserPassword $password,
        UserRole $role
    ): User {
        $reflectionClass = new \ReflectionClass(User::class);

        /** @var User $user */
        $user = $reflectionClass->newInstanceWithoutConstructor();

        $data = [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role,
            'deleted' => false,
            'createdAt' => new \DateTimeImmutable('now'),
            'updatedAt' => new \DateTimeImmutable('now'),
        ];

        self::setProperties($reflectionClass, $user, $data);

        return $user;
    }

    public static function withFields(array $fields = []): User
    {
        $reflectionClass = new \ReflectionClass(User::class);

        /** @var User $anInstance */
        $anInstance = $reflectionClass->newInstanceWithoutConstructor();

        $data = self::generateDataArray($fields, $reflectionClass, self::$fieldTypeMapping);
        self::setProperties($reflectionClass, $anInstance, $data);

        return $anInstance;
    }
}
