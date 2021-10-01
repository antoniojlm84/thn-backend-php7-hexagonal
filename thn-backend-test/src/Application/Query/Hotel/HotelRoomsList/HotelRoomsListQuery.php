<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query\Hotel\HotelRoomsList;

use Thn\BackendTest\Application\Query\QueryMultipleResource;
use Thn\BackendTest\Domain\Model\User\User;

class HotelRoomsListQuery extends QueryMultipleResource
{
    public function __construct(
        ?User $loggedUser,
        array $include
    ) {
        $this->includes = $include;
        $this->loggedUser = $loggedUser;
    }

    public function includes(): array
    {
        return $this->includes;
    }
}
