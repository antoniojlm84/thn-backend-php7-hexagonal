<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Hotel;

use Thn\BackendTest\Domain\Collection\AbstractEntityCollection;

class HotelCollection extends AbstractEntityCollection
{
    public function addHotel(Hotel $Hotel): void
    {
        $this->addItem($Hotel);
    }

    public function addHotels(iterable $Hotels): void
    {
        foreach ($Hotels as $Hotel) {
            $this->addHotel($Hotel);
        }
    }
}
