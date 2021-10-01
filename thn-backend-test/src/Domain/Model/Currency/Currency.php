<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Currency;

class Currency
{
    /** @var CurrencyId */
    protected $id;

    /** @var CurrencyName */
    protected $name;

    /** @var CurrencySymbol */
    private $symbol;

    public function __construct(CurrencyId $isoCode, CurrencyName $name, CurrencySymbol $symbol)
    {
        $this->id = $isoCode;
        $this->name = $name;
        $this->symbol = $symbol;
    }

    public function id(): CurrencyId
    {
        return $this->id;
    }

    public function name(): CurrencyName
    {
        return $this->name;
    }

    public function symbol(): CurrencySymbol
    {
        return $this->symbol;
    }
}
