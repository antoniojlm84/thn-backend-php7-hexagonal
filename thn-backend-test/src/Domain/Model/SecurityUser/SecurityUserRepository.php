<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\SecurityUser;

use Thn\BackendTest\Domain\Model\User\UserId;

interface SecurityUserRepository
{
    public function securityUserById(UserId $id): ?SecurityUser;
}
