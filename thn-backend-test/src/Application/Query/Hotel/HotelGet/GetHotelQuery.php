<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query\Hotel\HotelGet;

use Thn\BackendTest\Application\Query\QuerySingleResource;
use Thn\BackendTest\Domain\Model\User\User;

class GetHotelQuery extends QuerySingleResource
{
    /** @var string */
    private $hotelId;

    public function __construct(
        ?User $loggedUser,
        string $hotelId,
        array $include
    ) {
        $this->hotelId = $hotelId;
        $this->includes = $include;
        $this->loggedUser = $loggedUser;
    }

    public function hotelId(): string
    {
        return $this->hotelId;
    }

    public function includes(): array
    {
        return $this->includes;
    }
}
