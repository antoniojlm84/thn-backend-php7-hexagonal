<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\User;

interface SecurityUserRepository
{
    public function securityUserById(UserId $id): ?SecurityUser;
}
