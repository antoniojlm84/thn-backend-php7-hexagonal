<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\ValueObject;

abstract class StringValueObject
{
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value();
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equalsTo(string $value)
    {
        return $this->value === $value;
    }
}
