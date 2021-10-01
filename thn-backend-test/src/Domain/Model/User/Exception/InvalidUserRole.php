<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\User\Exception;

use Thn\BackendTest\Domain\Exception\DomainException;

final class InvalidUserRole extends DomainException
{
    private const STATUS_CODE = 400;

    public function __construct(string $role)
    {
        parent::__construct(
            sprintf('Invalid role %s.', $role),
            self::STATUS_CODE
        );
    }
}
