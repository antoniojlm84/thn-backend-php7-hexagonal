<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Country\Exception;

use Thn\BackendTest\Domain\Exception\DomainException;

class CountryNotFound extends DomainException
{
    private const STATUS_CODE = 404;

    public function __construct(string $code)
    {
        parent::__construct(
            sprintf(
                'Country with code %s not found',
                $code
            ),
            self::STATUS_CODE
        );
    }
}
