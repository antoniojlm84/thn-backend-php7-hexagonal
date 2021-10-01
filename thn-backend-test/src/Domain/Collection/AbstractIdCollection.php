<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Collection;

class AbstractIdCollection extends AbstractCollection
{
    protected function calculateHash($item): string
    {
        return $item->value();
    }
}
