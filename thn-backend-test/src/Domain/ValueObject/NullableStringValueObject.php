<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\ValueObject;

abstract class NullableStringValueObject
{
    protected $value;

    public function __construct(?string $value)
    {
        $this->value = $value;
    }

    public function __toString()
    {
        return is_null($this->value()) ? '' : $this->value();
    }

    public function value(): ?string
    {
        return $this->value;
    }

    public function isNull(): bool
    {
        return is_null($this->value);
    }

    public function equalsTo(string $value)
    {
        return $this->value === $value;
    }
}
