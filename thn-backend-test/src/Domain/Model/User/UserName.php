<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\User;

use Thn\BackendTest\Domain\Model\User\Exception\InvalidUserNameLength;
use Thn\BackendTest\Domain\ValueObject\StringValueObject;

class UserName extends StringValueObject
{
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->validateMinLength($name);
        $this->validateMaxLength($name);
    }

    /**
     * @throws InvalidUserNameLength
     */
    private function validateMinLength(string $name): void
    {
        if (strlen($name) < 3) {
            throw new InvalidUserNameLength($name);
        }
    }

    /**
     * @throws InvalidUserNameLength
     */
    private function validateMaxLength(string $name): void
    {
        if (strlen($name) > 50) {
            throw new InvalidUserNameLength($name);
        }
    }
}
