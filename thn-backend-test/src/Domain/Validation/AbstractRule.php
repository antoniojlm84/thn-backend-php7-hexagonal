<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Validation;

abstract class AbstractRule
{
    public static function create()
    {
        return new static();
    }

    abstract public function execute($value): bool;
}
