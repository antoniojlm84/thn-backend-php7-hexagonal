<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query\Hotel\HotelRoomsList;

use Thn\BackendTest\Domain\Model\Hotel\HotelRepository;
use Thn\BackendTest\Domain\Model\Hotel\Exception\HotelNotFound;
use Thn\BackendTest\Domain\Model\User\User;

class HotelRoomsListQueryService
{
    /** @var HotelRepository */
    private $hotelRepository;

    /** @var HotelRoomsListDataTransformer */
    private $dataTransformer;

    public function __construct(
        HotelRepository $hotelRepository,
        HotelRoomsListDataTransformer $dataTransformer
    ) {
        $this->dataTransformer = $dataTransformer;
        $this->hotelRepository = $hotelRepository;
    }

    /**
     * @throws HotelNotFound
     */
    public function execute(
        ?User $loggedUser,
        array $includes
    ): array {
        $hotels = $this->hotelRepository->roomList();

        $this->dataTransformer->write(
            new HotelRoomsListQueryResponse(
                $hotels,
                $includes
            )
        );

        return $this->dataTransformer->read();
    }
}
