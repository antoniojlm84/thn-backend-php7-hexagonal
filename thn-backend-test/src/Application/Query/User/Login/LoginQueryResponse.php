<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query\User\Login;

use Thn\BackendTest\Domain\Model\User\UserToken;

class LoginQueryResponse
{
    /** @var UserToken */
    private $accessToken;

    /** @var string */
    private $tokenType;

    public function __construct(
        UserToken $accessToken,
        string $tokenType
    ) {
        $this->accessToken = $accessToken;
        $this->tokenType = $tokenType;
    }

    public function accessToken(): UserToken
    {
        return $this->accessToken;
    }

    public function tokenType(): string
    {
        return $this->tokenType;
    }
}
