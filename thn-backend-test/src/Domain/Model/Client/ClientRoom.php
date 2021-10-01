<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Client;

use Thn\BackendTest\Domain\Model\Room\RoomId;

class ClientRoom
{
    /** @var ClientId */
    private $clientId;

    /** @var RoomId */
    private $roomId;

    public function __construct(
        ClientId $clientId,
        RoomId $roomId
    ) {
        $this->clientId = $clientId;
        $this->roomId = $roomId;
    }

    public function clientId(): ClientId
    {
        return $this->clientId;
    }

    public function roomId(): RoomId
    {
        return $this->roomId;
    }
}
