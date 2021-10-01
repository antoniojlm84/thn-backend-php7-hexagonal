<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Collection;

class AbstractEntityCollection extends AbstractCollection
{
    protected function calculateHash($item): string
    {
        return (string) $item->id()->value();
    }
}
