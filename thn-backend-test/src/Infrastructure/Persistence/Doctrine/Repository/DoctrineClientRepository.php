<?php

declare(strict_types=1);

namespace Thn\BackendTest\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Thn\BackendTest\Domain\Model\Client\Client;
use Thn\BackendTest\Domain\Model\Client\ClientCollection;
use Thn\BackendTest\Domain\Model\Client\ClientId;
use Thn\BackendTest\Domain\Model\Client\ClientRepository;
use Thn\BackendTest\Domain\Model\Client\ClientRoom;
use Thn\BackendTest\Domain\Model\Client\ClientRoomCollection;
use Thn\BackendTest\Domain\Model\Room\Room;
use Thn\BackendTest\Domain\Model\Room\RoomCollection;
use Thn\BackendTest\Infrastructure\Persistence\Doctrine\PropertyHydrator;

class DoctrineClientRepository extends DoctrineRepository implements ClientRepository
{
    use PropertyHydrator;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Client::class);
    }

    public function save(Client $client, ?array $relations = null): void
    {
        $this->entityManager->persist($client);
    }

    public function byId(ClientId $clientId, array $includes = null): ?Client
    {
        /** @var null|Client $client */
        $client = $this->repository->findOneBy(
            [
                'id' => $clientId,
            ]
        );

        return $client;
    }

    public function byRoomsBooked(): ClientCollection
    {
        $clientCollection = ClientCollection::create();

        /** @var QueryBuilder $qb */
        $results = $this->repository->createQueryBuilder('client')
            ->select('client', 'clientRoom','room')
            ->leftJoin(
                ClientRoom::class,
                'clientRoom',
                'WITH',
                'clientRoom.clientId = client.id'
            )->innerJoin(
                Room::class,
                'room',
                'WITH',
                'room.id = clientRoom.roomId'
            )
            ->where('client.deleted = 0')
            ->getQuery()
            ->getResult()
        ;

        $rooms = [];
        $clientRooms = [];

        foreach ($results as $result) {
            if ($result instanceof Client) {
                $clientCollection->addClient($result);
            }

            if ($result instanceof Room) {
                $rooms[$result->id()->value()] = $result;
            }

            if ($result instanceof ClientRoom) {
                if (false === isset($clientRooms[$result->clientId()->value()])) {
                    $clientRooms[$result->clientId()->value()] = [];
                }
                $clientRooms[$result->clientId()->value()][] = $result;
            }
        }

        /** @var Client $client */
        foreach ($clientCollection as $client) {
            $clientRoomCollection = ClientRoomCollection::create();
            $roomCollection = RoomCollection::create();
            /** @var ClientRoom $clientRoom */
            foreach ($clientRooms[$client->id()->value()] as $clientRoom) {
                $clientRoomCollection->addClientRoom($clientRoom);
                $roomCollection->addRoom($rooms[$clientRoom->roomId()->value()]);
            }

            $this->hydrateProperty(
                $client,
                'clientRoomCollection',
                $clientRoomCollection
            );

            $this->hydrateProperty(
                $client,
                'rooms',
                $roomCollection
            );
        }

        return $clientCollection;
    }

    public function count(): int
    {
        return (int) $this->repository->createQueryBuilder('client')
            ->select('count(distinct(client))')
            ->where('client.deleted = 0')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
}
