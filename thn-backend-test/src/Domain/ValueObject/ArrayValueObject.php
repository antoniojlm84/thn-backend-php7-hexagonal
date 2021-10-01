<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\ValueObject;

abstract class ArrayValueObject
{
    protected $value;

    public function __construct(array $value)
    {
        $this->value = $value;
    }

    public function value(): array
    {
        return $this->value;
    }

    public function equalsTo(ArrayValueObject $other): bool
    {
        return $this->value() === $other->value();
    }

    public function isBiggerThan(ArrayValueObject $other): bool
    {
        return $this->value() > $other->value();
    }
}
