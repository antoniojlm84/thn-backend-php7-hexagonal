<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\SecurityUser;

use Thn\BackendTest\Domain\Model\User\UserId;
use Thn\BackendTest\Domain\Model\User\UserRole;

interface SecurityUserInterface
{
    public function id(): UserId;

    public function deleted(): bool;

    public function role(): UserRole;

    public function isAdmin(): bool;

    public function hasRole(UserRole $role): bool;
}
