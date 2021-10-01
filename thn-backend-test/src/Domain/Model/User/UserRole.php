<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\User;

use Thn\BackendTest\Domain\Model\User\Exception\InvalidRole;
use Thn\BackendTest\Domain\ValueObject\StringValueObject;

class UserRole extends StringValueObject
{
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_USER = 'ROLE_USER';


    public static $roles = [
        self::ROLE_ADMIN,
        self::ROLE_USER
    ];

    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->validateRole($name);
    }

    public static function admin(): self
    {
        return new self(self::ROLE_ADMIN);
    }

    /**
     * @throws InvalidRole
     */
    private function validateRole(string $name): void
    {
        if (false === in_array($name, self::$roles)) {
            throw new InvalidRole($name);
        }
    }
}
