<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query\User\Login;

class LoginQuery
{
    /** @var string */
    private $userEmail;

    /** @var string */
    private $userPassword;

    public function __construct(
        string $userEmail,
        string $userPassword
    ) {
        $this->userEmail = $userEmail;
        $this->userPassword = $userPassword;
    }

    public function userEmail(): string
    {
        return $this->userEmail;
    }

    public function userPassword(): string
    {
        return $this->userPassword;
    }
}
