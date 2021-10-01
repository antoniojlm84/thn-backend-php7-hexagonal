<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query\Hotel\HotelRoomsList;

use Thn\BackendTest\Domain\Query\QueryResponse;
use Thn\BackendTest\Infrastructure\Delivery\Response\JsonApi\Transformer\JsonApiHotelTransformer;

class HotelRoomsListDataTransformer
{
    /** @var HotelRoomsListQueryResponse */
    private $hotelRoomsListResponse;

    public function write(QueryResponse $object)
    {
        $this->hotelRoomsListResponse = $object;
    }

    public function read(): array
    {
        $transformer = new JsonApiHotelTransformer('hotels');
        return $transformer->transform($this->hotelRoomsListResponse);
    }
}
