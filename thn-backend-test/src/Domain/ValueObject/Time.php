<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\ValueObject;

use Thn\BackendTest\Domain\Model\Time\Exception\TimeNotValid;

class Time extends StringValueObject
{
    public const FORMAT = 'H:i';

    public function __construct(string $value)
    {
        $this->validate($value);
        parent::__construct($value);
    }

    private function validate(string $value)
    {
        $datetime = \DateTimeImmutable::createFromFormat(self::FORMAT, $value);

        if (false === $datetime) {
            throw new TimeNotValid($value);
        }
    }
}
