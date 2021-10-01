<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\User\Exception;

use Thn\BackendTest\Domain\Exception\DomainException;

class InvalidUserPassword extends DomainException
{
    private const STATUS_CODE = 400;

    public function __construct(string $password)
    {
        parent::__construct(
            'The user password is not valid.',
            self::STATUS_CODE
        );
    }
}
