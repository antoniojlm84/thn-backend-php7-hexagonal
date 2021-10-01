<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Country;

use Thn\BackendTest\Domain\Collection\AbstractEntityCollection;

class CountryCollection extends AbstractEntityCollection
{
    public function addCountry(Country $country)
    {
        $this->addItem($country);
    }

    public function addCountries(iterable $countries)
    {
        foreach ($countries as $country) {
            $this->addCountry($country);
        }
    }

    protected function calculateHash($item): string
    {
        return $item->iso()->value();
    }
}
