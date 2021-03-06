<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\ValueObject;

abstract class IntValueObject
{
    protected $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equalsTo(IntValueObject $other): bool
    {
        return $this->value() === $other->value();
    }

    public function isBiggerThan(IntValueObject $other): bool
    {
        return $this->value() > $other->value();
    }
}
