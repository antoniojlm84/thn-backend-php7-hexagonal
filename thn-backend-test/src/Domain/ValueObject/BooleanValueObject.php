<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\ValueObject;

abstract class BooleanValueObject
{
    protected $value;

    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    public function __toString()
    {
        return boolval($this->value());
    }

    public function value(): bool
    {
        return $this->value;
    }
}
