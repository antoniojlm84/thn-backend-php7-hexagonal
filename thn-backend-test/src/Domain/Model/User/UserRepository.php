<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\User;

use Thn\BackendTest\Domain\Model\Email\Email;

interface UserRepository
{
    public function byEmail(Email $userEmail): ?User;

    public function save(User $user): void;

    public function byId(UserId $userId): ?User;

    public function count(): int;
}
