<?php

declare(strict_types=1);

namespace Thn\BackendTest\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Thn\BackendTest\Domain\Model\Hotel\Hotel;
use Thn\BackendTest\Domain\Model\Hotel\HotelCollection;
use Thn\BackendTest\Domain\Model\Hotel\HotelId;
use Thn\BackendTest\Domain\Model\Hotel\HotelRepository;
use Thn\BackendTest\Domain\Model\Hotel\HotelRoom;
use Thn\BackendTest\Domain\Model\Hotel\HotelRoomCollection;
use Thn\BackendTest\Domain\Model\Room\Room;
use Thn\BackendTest\Domain\Model\Room\RoomCollection;
use Thn\BackendTest\Domain\Model\User\User;
use Thn\BackendTest\Infrastructure\Persistence\Doctrine\PropertyHydrator;

class DoctrineHotelRepository extends DoctrineRepository implements HotelRepository
{
    use PropertyHydrator;

    protected static $availableIncludes = [
        'rooms'
    ];

    protected static $relations = [
        'hotelRoom'
    ];

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Hotel::class);
    }

    public function save(Hotel $hotel, ?array $relations = null): void
    {
        $this->entityManager->persist($hotel);
    }

    public function byId(HotelId $hotelId): ?Hotel
    {
        /** @var null|Hotel $hotel */
        $hotel = $this->repository->findOneBy(
            [
                'id' => $hotelId,
            ]
        );

        if (null !== $hotel) {
            $hydrateIncludes = $includes ?? self::$availableIncludes;
            $this->hydrateRelations(
                $hotel,
                $hydrateIncludes
            );
        }

        return $hotel;
    }

    public function count(): int
    {
        return (int)$this->repository->createQueryBuilder('hotel')
            ->select('count(distinct(hotel))')
            ->where('hotel.deleted = 0')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function roomList(): HotelCollection
    {
        $hotelCollection = HotelCollection::create();

        /** @var QueryBuilder $qb */
        $results = $this->repository->createQueryBuilder('hotel')
            ->select('hotel', 'hotelRoom','room')
            ->leftJoin(
                HotelRoom::class,
                'hotelRoom',
                'WITH',
                'hotelRoom.hotelId = hotel.id'
            )->innerJoin(
                Room::class,
                'room',
                'WITH',
                'room.id = hotelRoom.roomId'
            )
            ->where('hotel.deleted = 0')
            ->getQuery()
            ->getResult()
        ;

        $rooms = [];
        $hotelRooms = [];

        foreach ($results as $result) {
            if ($result instanceof Hotel) {
                $hotelCollection->addHotel($result);
            }

            if ($result instanceof Room) {
                $rooms[$result->id()->value()] = $result;
            }

            if ($result instanceof HotelRoom) {
                if (false === isset($hotelRooms[$result->hotelId()->value()])) {
                    $hotelRooms[$result->hotelId()->value()] = [];
                }
                $hotelRooms[$result->hotelId()->value()][] = $result;
            }
        }

        /** @var Hotel $hotel */
        foreach ($hotelCollection as $hotel) {
            $hotelRoomCollection = HotelRoomCollection::create();
            $roomCollection = RoomCollection::create();
            /** @var HotelRoom $hotelRoom */
            foreach ($hotelRooms[$hotel->id()->value()] as $hotelRoom) {
                $hotelRoomCollection->addHotelRoom($hotelRoom);
                $roomCollection->addRoom($rooms[$hotelRoom->roomId()->value()]);
            }

            $this->hydrateProperty(
                $hotel,
                'hotelRoomCollection',
                $hotelRoomCollection
            );

            $this->hydrateProperty(
                $hotel,
                'rooms',
                $roomCollection
            );
        }

        return $hotelCollection;
    }


    private function hydrateRooms(Hotel $hotel): void
    {
        $results = $this->entityManager->createQueryBuilder()
            ->select('hotel_room, room')
            ->from(
                HotelRoom::class,
                'hotel_room'
            )
            ->innerJoin(
                Room::class,
                'room',
                'WITH',
                'room.id = hotel_room.roomId'
            )
            ->where('hotel_room.hotelId = :hotelId')
            ->setParameter('hotelId', $hotel->id())
            ->getQuery()
            ->getResult()
        ;

        $hotelRoomCollection = HotelRoomCollection::create();
        $roomCollection = RoomCollection::create();
        foreach ($results as $result) {
            if ($result instanceof HotelRoom) {
                $hotelRoomCollection->addHotelRoom($result);
            }

            if ($result instanceof Room) {
                $roomCollection->addRoom($result);
            }
        }

        $this->hydrateProperty(
            $hotel,
            'hotelRoomCollection',
            $hotelRoomCollection
        );

        $this->hydrateProperty(
            $hotel,
            'rooms',
            $roomCollection
        );
    }
}
