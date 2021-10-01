<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Validation;

class StringLengthMin extends AbstractRule
{
    /** @var null */
    private $minimum;

    public function min(int $value)
    {
        $this->minimum = $value;

        return $this;
    }

    public function execute($value): bool
    {
        return strlen($value) >= $this->minimum;
    }
}
