<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query;

use Thn\BackendTest\Domain\Model\User\User;
use Thn\BackendTest\Domain\Query\SingleResourceQuery;

abstract class QuerySingleResource implements SingleResourceQuery
{
    /** @var User */
    protected $loggedUser;

    /** @var null|array */
    protected $includes;

    public function __construct(
        ?User $loggedUser,
        array $include
    ) {
        $this->loggedUser = $loggedUser;
        $this->includes = $include;
    }

    public function loggedUser(): ?User
    {
        return $this->loggedUser;
    }

    public function includes(): array
    {
        return $this->includes;
    }
}
