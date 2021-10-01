<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\User\Exception;

use Thn\BackendTest\Domain\Exception\DomainException;

final class InvalidUserNameLength extends DomainException
{
    private const STATUS_CODE = 400;

    public function __construct(string $name)
    {
        parent::__construct(
            sprintf('The name %s contains an invalid length.', $name),
            self::STATUS_CODE
        );
    }
}
