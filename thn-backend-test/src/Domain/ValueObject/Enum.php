<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\ValueObject;

use InvalidArgumentException;

abstract class Enum
{
    private $value;

    public function __construct(string $value)
    {
        $this->ensureIsValidValue($value);

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    abstract public function getPossibleValues(): array;

    private function ensureIsValidValue($value): void
    {
        if (!in_array($value, $this->getPossibleValues())) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $value)
            );
        }
    }
}
