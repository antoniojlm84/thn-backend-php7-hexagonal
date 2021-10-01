<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query\Room\RoomGet;

use Thn\BackendTest\Domain\Model\Room\Room;
use Thn\BackendTest\Domain\Query\SingleResourceResponse;

class GetRoomQueryResponse implements SingleResourceResponse
{
    /** @var Room */
    private $resource;

    /** @var array */
    private $includes;

    public function __construct(
        Room $room,
        array $includes
    ) {
        $this->resource = $room;
        $this->includes = $includes;
    }

    public function resource(): Room
    {
        return $this->resource;
    }

    public function includes(): array
    {
        return $this->includes;
    }
}
