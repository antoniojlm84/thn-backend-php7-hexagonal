<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query\Hotel\HotelGet;

use Thn\BackendTest\Domain\Query\QueryResponse;
use Thn\BackendTest\Infrastructure\Delivery\Response\JsonApi\Transformer\JsonApiHotelTransformer;

class GetHotelDataTransformer
{
    /** @var GetHotelQueryResponse */
    private $getHotelResponse;

    public function write(QueryResponse $object)
    {
        $this->getHotelResponse = $object;
    }

    public function read(): array
    {
        $transformer = new JsonApiHotelTransformer('hotels');
        return $transformer->transform($this->getHotelResponse);
    }
}
