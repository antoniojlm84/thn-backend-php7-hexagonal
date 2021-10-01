<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Currency;

use Thn\BackendTest\Domain\Collection\AbstractCollection;

class CurrencyIdCollection extends AbstractCollection
{
    public function addCurrencyId(CurrencyId $currencyId): void
    {
        $this->addItem($currencyId);
    }

    public function addCurrencyIds(iterable $currencies): void
    {
        foreach ($currencies as $currencyId) {
            $this->addCurrencyId($currencyId);
        }
    }

    protected function calculateHash($item): string
    {
        return $item->value();
    }
}
