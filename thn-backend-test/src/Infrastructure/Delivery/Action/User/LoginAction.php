<?php

declare(strict_types=1);

namespace Thn\BackendTest\Infrastructure\Delivery\Action\User;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Thn\BackendTest\Application\Query\User\Login\LoginQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Thn\BackendTest\Application\Query\User\Login\LoginQueryHandler;

class LoginAction extends AbstractController
{
    /** @var LoginQueryHandler */
    private $loginQueryHandler;

    public function __construct(LoginQueryHandler $loginQueryHandler)
    {
        $this->loginQueryHandler = $loginQueryHandler;
    }

    public function __invoke(Request $request)
    {
        $user = $request->get('user');
        $password = $request->get('password');

        if (false === isset($user) || false === isset($password)) {
            throw new BadRequestException('Invalid login data',404);
        }

        $loginQuery = new LoginQuery(
            $user,
            $password
        );

        return new JsonResponse(
            $this->loginQueryHandler->__invoke($loginQuery)
        );
    }
}
