<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\User;

interface SecurityUser
{
    public function id(): UserId;

    public function deleted(): bool;

    public function role(): UserRole;

    public function isAdmin(): bool;

    public function hasRole(UserRole $role): bool;
}
