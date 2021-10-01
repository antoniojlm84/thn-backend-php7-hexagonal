<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query\Client\ClientBookedRoomList;

use Thn\BackendTest\Domain\Model\Client\ClientCollection;
use Thn\BackendTest\Domain\Query\MultipleResourceResponse;

class ClientBookedRoomListQueryResponse implements MultipleResourceResponse
{
    /** @var ClientCollection */
    private $resource;

    /** @var array */
    private $includes;

    public function __construct(
        ClientCollection $clients,
        array $includes
    ) {
        $this->resource = $clients;
        $this->includes = $includes;
    }

    public function resource(): ClientCollection
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
