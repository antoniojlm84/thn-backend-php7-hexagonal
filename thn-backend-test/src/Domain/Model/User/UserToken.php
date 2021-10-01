<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\User;

class UserToken
{
    /** @var string */
    private $token;

    /** @var int */
    private $expiresIn;

    public function __construct(
        string $token,
        int $expiresIn
    ) {
        $this->token = $token;
        $this->expiresIn = $expiresIn;
    }

    public function token(): string
    {
        return $this->token;
    }

    public function expiresIn(): int
    {
        return $this->expiresIn;
    }
}
