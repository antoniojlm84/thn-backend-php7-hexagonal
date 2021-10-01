<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Client;

use Thn\BackendTest\Domain\Collection\AbstractCollection;

class ClientRoomCollection extends AbstractCollection
{
    public function addClientRoom(ClientRoom $clientRoom)
    {
        $this->addItem($clientRoom);
    }

    public function addClientRooms(iterable $clientRooms)
    {
        foreach ($clientRooms as $clientRoom) {
            $this->addClientRoom($clientRoom);
        }
    }

    protected function calculateHash($item): string
    {
        return md5($item->clientId()->value().$item->roomId()->value());
    }
}
