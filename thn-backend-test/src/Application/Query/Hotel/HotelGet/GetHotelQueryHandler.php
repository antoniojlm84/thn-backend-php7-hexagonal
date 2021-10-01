<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query\Hotel\HotelGet;

use Thn\BackendTest\Domain\Model\Hotel\HotelId;

class GetHotelQueryHandler
{
    /** @var GetHotelQueryService */
    private $getHotelQueryService;

    public function __construct(
        GetHotelQueryService $getHotelQueryService
    ) {
        $this->getHotelQueryService = $getHotelQueryService;
    }

    public function __invoke(GetHotelQuery $getUserQuery)
    {
        return $this->getHotelQueryService->execute(
            $getUserQuery->loggedUser(),
            new HotelId($getUserQuery->hotelId()),
            $getUserQuery->includes()
        );
    }
}
