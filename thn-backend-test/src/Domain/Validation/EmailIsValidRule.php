<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Validation;

class EmailIsValidRule extends AbstractRule
{
    public function execute($value): bool
    {
        return false === \filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
