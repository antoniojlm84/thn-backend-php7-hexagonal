<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Validation;

class Assert
{
    public static function isEmail(string $value): bool
    {
        return EmailIsValidRule::create()->execute($value);
    }

    public static function stringLengthMin(string $string, int $minimum)
    {
        return StringLengthMin::create()->min($minimum)->execute($string);
    }

    public static function stringLengthMax(string $string, int $maximum)
    {
        return StringLengthMax::create()->max($maximum)->execute($string);
    }
}
