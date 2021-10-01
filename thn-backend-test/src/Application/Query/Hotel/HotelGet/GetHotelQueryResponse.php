<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query\Hotel\HotelGet;

use Thn\BackendTest\Domain\Model\Hotel\Hotel;
use Thn\BackendTest\Domain\Query\SingleResourceResponse;

class GetHotelQueryResponse implements SingleResourceResponse
{
    /** @var Hotel */
    private $resource;

    /** @var array */
    private $includes;

    public function __construct(
        Hotel $hotel,
        array $includes
    ) {
        $this->resource = $hotel;
        $this->includes = $includes;
    }

    public function resource(): Hotel
    {
        return $this->resource;
    }

    public function includes(): array
    {
        return $this->includes;
    }
}
