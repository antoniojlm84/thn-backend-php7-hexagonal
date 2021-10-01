<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Transformer;

use Thn\BackendTest\Domain\Query\QueryResponse;

interface Transformer
{
    public function transform(QueryResponse $data) :array;
    public function responseMultiResult(QueryResponse $data): array;
    public function includes(array $includes, QueryResponse $data): void;
}
