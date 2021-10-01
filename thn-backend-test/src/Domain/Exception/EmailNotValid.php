<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Exception;

class EmailNotValid extends DomainException
{
    private const STATUS_CODE = 400;

    public function __construct(string $email = '')
    {
        parent::__construct(
            sprintf('The user email %s not valid.', $email),
            self::STATUS_CODE
        );
    }
}
