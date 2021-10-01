<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query\User\Login;

class LoginDataTransformer
{
    /** @var LoginQueryResponse */
    private $loginQueryResponse;

    public function write(LoginQueryResponse $loginQueryResponse)
    {
        $this->loginQueryResponse = $loginQueryResponse;
    }

    public function read()
    {
        return [
            'token_type' => $this->loginQueryResponse->tokenType(),
            'access_token' => $this->loginQueryResponse->accessToken()->token(),
            'expires_in' => $this->loginQueryResponse->accessToken()->expiresIn()
        ];
    }
}
