<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query\Client\ClientBookedRoomList;

use Thn\BackendTest\Domain\Model\Client\ClientRepository;
use Thn\BackendTest\Domain\Model\User\User;

class ClientBookedRoomListQueryService
{
    /** @var ClientRepository */
    private $clientRepository;

    /** @var ClientBookedRoomListDataTransformer */
    private $dataTransformer;

    public function __construct(
        ClientRepository $clientRepository,
        ClientBookedRoomListDataTransformer $dataTransformer
    ) {
        $this->dataTransformer = $dataTransformer;
        $this->clientRepository = $clientRepository;
    }

    public function execute(
        ?User $loggedUser,
        array $includes
    ): array {
        $clients = $this->clientRepository->byRoomsBooked();

        $this->dataTransformer->write(
            new ClientBookedRoomListQueryResponse(
                $clients,
                $includes
            )
        );

        return $this->dataTransformer->read();
    }
}
