<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Exception;

class InvalidDateRange extends DomainException
{
    private const STATUS_CODE = 400;

    public function __construct()
    {
        parent::__construct(
            sprintf('Initial date must be lower than the end.'),
            self::STATUS_CODE
        );
    }
}
