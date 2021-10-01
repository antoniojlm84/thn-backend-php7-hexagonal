<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Currency;

use Thn\BackendTest\Domain\Criteria\Expr\Criteria;

interface CurrencyRepository
{
    public function byId(CurrencyId $isoCode): ?Currency;

    public function all(): CurrencyCollection;

    public function byCriteria(Criteria $criteria): CurrencyCollection;
}
