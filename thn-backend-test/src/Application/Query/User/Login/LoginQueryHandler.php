<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query\User\Login;

use Thn\BackendTest\Domain\Model\Email\Email;
use Thn\BackendTest\Domain\Model\User\UserPassword;

class LoginQueryHandler
{
    /** @var LoginQueryService */
    private $loginQueryService;

    public function __construct(
        LoginQueryService $loginQueryService
    ) {
        $this->loginQueryService = $loginQueryService;
    }

    public function __invoke(LoginQuery $loginQuery)
    {
        $userEmail = new Email($loginQuery->userEmail());
        $userPassword = new UserPassword($loginQuery->userPassword());

        return $this->loginQueryService->execute($userEmail, $userPassword);
    }
}
