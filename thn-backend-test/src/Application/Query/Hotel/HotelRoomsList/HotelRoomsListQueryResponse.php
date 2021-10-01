<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query\Hotel\HotelRoomsList;

use Thn\BackendTest\Domain\Model\Hotel\HotelCollection;
use Thn\BackendTest\Domain\Query\MultipleResourceResponse;

class HotelRoomsListQueryResponse implements MultipleResourceResponse
{
    /** @var HotelCollection */
    private $resource;

    /** @var array */
    private $includes;

    public function __construct(
        HotelCollection $hotel,
        array $includes
    ) {
        $this->resource = $hotel;
        $this->includes = $includes;
    }

    public function resource(): HotelCollection
    {
        return $this->resource;
    }

    public function includes(): array
    {
        return $this->includes;
    }

    public function totals(): int
    {
         return $this->resource->count();
    }
}
