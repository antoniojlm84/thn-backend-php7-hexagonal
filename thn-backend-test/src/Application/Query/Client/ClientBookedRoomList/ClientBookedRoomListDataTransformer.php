<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query\Client\ClientBookedRoomList;

use Thn\BackendTest\Domain\Query\QueryResponse;
use Thn\BackendTest\Infrastructure\Delivery\Response\JsonApi\Transformer\JsonApiClientTransformer;

class ClientBookedRoomListDataTransformer
{
    /** @var ClientBookedRoomListListQueryResponse */
    private $ClientBookedRoomListListResponse;

    public function write(QueryResponse $object)
    {
        $this->ClientBookedRoomListListResponse = $object;
    }

    public function read(): array
    {
        $transformer = new JsonApiClientTransformer('clients');
        return $transformer->transform($this->ClientBookedRoomListListResponse);
    }
}
