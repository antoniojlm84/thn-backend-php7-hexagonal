<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\User;

use Thn\BackendTest\Domain\Collection\AbstractEntityCollection;

class UserCollection extends AbstractEntityCollection
{
    public function addUser(User $user): void
    {
        $this->addItem($user);
    }

    public function addUsers(iterable $users): void
    {
        foreach ($users as $user) {
            $this->addUser($user);
        }
    }
}
