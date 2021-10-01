<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query\Hotel\HotelRoomsList;

use Thn\BackendTest\Domain\Model\Hotel\HotelId;

class HotelRoomsListQueryHandler
{
    /** @var HotelRoomsListQueryService */
    private $HotelRoomsListQueryService;

    public function __construct(
        HotelRoomsListQueryService $HotelRoomsListQueryService
    ) {
        $this->HotelRoomsListQueryService = $HotelRoomsListQueryService;
    }

    public function __invoke(HotelRoomsListQuery $getUserQuery)
    {
        return $this->HotelRoomsListQueryService->execute(
            $getUserQuery->loggedUser(),
            $getUserQuery->includes()
        );
    }
}
