<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Query;

interface SingleResourceResponse extends QueryResponse
{
    public function includes(): array;

    public function resource();
}
