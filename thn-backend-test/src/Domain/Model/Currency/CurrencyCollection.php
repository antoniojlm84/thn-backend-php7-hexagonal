<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Currency;

use Thn\BackendTest\Domain\Collection\AbstractEntityCollection;

class CurrencyCollection extends AbstractEntityCollection
{
    public function addCurrency(Currency $currency): void
    {
        $this->addItem($currency);
    }

    public function addCurrencies(iterable $currencies): void
    {
        foreach ($currencies as $currency) {
            $this->addCurrency($currency);
        }
    }
}
