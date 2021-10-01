<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Query;

interface MultipleResourceResponse extends QueryResponse
{
    public function totals(): int;

    public function includes(): array;

    public function resource();
}
