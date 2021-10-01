<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Validation;

class StringLengthMax extends AbstractRule
{
    /** @var int */
    private $maximum;

    public function max(int $maximum)
    {
        $this->maximum = $maximum;

        return $this;
    }

    public function execute($value): bool
    {
        return strlen($value) <= $this->maximum;
    }
}
