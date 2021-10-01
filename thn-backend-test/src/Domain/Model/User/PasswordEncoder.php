<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\User;

use Thn\BackendTest\Domain\Model\User\Exception\InvalidUserPassword;
use Thn\BackendTest\Domain\Model\User\Exception\PasswordMismatch;

class PasswordEncoder
{
    public function encode(string $password): string
    {
        if (strlen($password) < 6) {
            throw new InvalidUserPassword($password);
        }

        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @throws PasswordMismatch
     */
    public function verify(string $password, string $hash): bool
    {
        $passwordMatch = password_verify($password, $hash);

        if (false === $passwordMatch) {
            throw new PasswordMismatch('Incorrect password, please try again.');
        }

        return $passwordMatch;
    }
}
