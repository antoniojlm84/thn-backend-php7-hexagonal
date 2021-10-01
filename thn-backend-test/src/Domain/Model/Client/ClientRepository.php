<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Client;

interface ClientRepository
{
    public function byId(
        ClientId $clientId,
        ?array $includes = null
    ): ?Client;

    public function save(
        Client $client,
        ?array $relations = null
    ): void;

    public function count(): int;
}
