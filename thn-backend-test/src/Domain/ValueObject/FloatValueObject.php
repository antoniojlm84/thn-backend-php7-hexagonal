<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\ValueObject;

abstract class FloatValueObject
{
    protected $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function value(): float
    {
        return $this->value;
    }

    public function equalsTo(FloatValueObject $other): bool
    {
        return $this->value() === $other->value();
    }

    public function isBiggerThan(FloatValueObject $other): bool
    {
        return $this->value() > $other->value();
    }
}
