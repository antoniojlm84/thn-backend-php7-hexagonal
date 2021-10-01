<?php

declare(strict_types=1);

namespace Thn\BackendTest\Infrastructure\Delivery\Action\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use Thn\BackendTest\Application\Query\Client\ClientBookedRoomList\ClientBookedRoomListQuery;
use Thn\BackendTest\Application\Query\Client\ClientBookedRoomList\ClientBookedRoomListQueryHandler;
use Thn\BackendTest\Domain\Model\User\User;

class GetRoomBookedListAction extends AbstractController
{
    /** @var Security */
    private $securityManager;

    /** @var ClientBookedRoomListQueryHandler */
    private $bookedRoomListListQueryHandler;

    public function __construct(
        Security $securityManager,
        ClientBookedRoomListQueryHandler $bookedRoomListListQueryHandler
    ) {
        $this->securityManager = $securityManager;
        $this->bookedRoomListListQueryHandler = $bookedRoomListListQueryHandler;
    }

    public function __invoke(Request $request): Response
    {
        /** @var User $user */
        $user = $this->securityManager->getUser();

        $roomBookedQuery = new ClientBookedRoomListQuery($user, []);

        return new JsonResponse(
            $this->bookedRoomListListQueryHandler->__invoke($roomBookedQuery)
        );
    }
}
