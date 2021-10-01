<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Query;

interface MultipleResourceQuery extends Query
{
    public function includes(): array;
}
