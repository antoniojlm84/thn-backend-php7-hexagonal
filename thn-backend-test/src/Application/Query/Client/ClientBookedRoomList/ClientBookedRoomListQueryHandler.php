<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query\Client\ClientBookedRoomList;

class ClientBookedRoomListQueryHandler
{
    /** @var ClientBookedRoomListQueryService */
    private $ClientBookedRoomListListQueryService;

    public function __construct(
        ClientBookedRoomListQueryService $ClientBookedRoomListListQueryService
    ) {
        $this->ClientBookedRoomListListQueryService = $ClientBookedRoomListListQueryService;
    }

    public function __invoke(ClientBookedRoomListQuery $getUserQuery)
    {
        return $this->ClientBookedRoomListListQueryService->execute(
            $getUserQuery->loggedUser(),
            $getUserQuery->includes()
        );
    }
}
