<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Currency\Exception;

use Thn\BackendTest\Domain\Model\Currency\CurrencyId;

class CurrencyNotFound extends \Exception
{
    private const STATUS_CODE = 404;

    public function __construct(CurrencyId $currencyId)
    {
        parent::__construct(
            sprintf('Currency with id %s not found!', $currencyId->value()),
            self::STATUS_CODE
        );
    }
}
