<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Country;

class Country
{
    /** @var CountryName */
    private $name;

    /** @var CountryIso */
    private $iso;

    private function __construct(
        CountryIso $iso,
        CountryName $name
    ) {
        $this->iso = $iso;
        $this->name = $name;
    }

    public static function create(
        CountryIso $iso,
        CountryName $name
    ): Country {
        return new self(
            $iso,
            $name
        );
    }

    public function name(): CountryName
    {
        return $this->name;
    }

    public function iso(): CountryIso
    {
        return $this->iso;
    }
}
