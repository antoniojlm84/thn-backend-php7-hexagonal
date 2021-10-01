<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\User;

use Thn\BackendTest\Domain\Model\TimeAwareTrait;
use Thn\BackendTest\Domain\Model\SecurityUser\SecurityUser;

class User extends SecurityUser
{
    use TimeAwareTrait;

    /** @var UserName */
    private $name;

    private function __construct()
    {
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public static function create(): User
    {
        return new self();
    }
}
