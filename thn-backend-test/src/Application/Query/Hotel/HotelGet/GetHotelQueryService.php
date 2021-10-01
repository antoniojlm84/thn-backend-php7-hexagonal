<?php

declare(strict_types=1);

namespace Thn\BackendTest\Application\Query\Hotel\HotelGet;

use Thn\BackendTest\Domain\Model\Hotel\HotelId;
use Thn\BackendTest\Domain\Model\Hotel\HotelRepository;
use Thn\BackendTest\Domain\Model\Hotel\Exception\HotelNotFound;
use Thn\BackendTest\Domain\Model\User\User;

class GetHotelQueryService
{
    /** @var HotelRepository */
    private $hotelRepository;

    /** @var GetHotelDataTransformer */
    private $dataTransformer;

    public function __construct(
        HotelRepository $hotelRepository,
        GetHotelDataTransformer $dataTransformer
    ) {
        $this->dataTransformer = $dataTransformer;
        $this->hotelRepository = $hotelRepository;
    }

    /**
     * @throws HotelNotFound
     */
    public function execute(
        ?User $loggedUser,
        HotelId $hotelId,
        array $includes
    ): array {
        $hotel = $this->hotelRepository->byId(
            $hotelId
        );

        if (true === empty($hotel)) {
            return ['Hotel with id: ' . $hotelId->value() . ' not found'];
        }

        $this->dataTransformer->write(
            new GetHotelQueryResponse(
                $hotel,
                $includes
            )
        );

        return $this->dataTransformer->read();
    }
}
