<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Client;

use Thn\BackendTest\Domain\Collection\AbstractEntityCollection;

class ClientCollection extends AbstractEntityCollection
{
    public function addClient(Client $client): void
    {
        $this->addItem($client);
    }

    public function addClients(iterable $clients): void
    {
        foreach ($clients as $client) {
            $this->addClient($client);
        }
    }
}
