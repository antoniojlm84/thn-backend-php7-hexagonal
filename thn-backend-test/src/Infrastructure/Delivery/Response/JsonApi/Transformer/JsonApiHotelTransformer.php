<?php

declare(strict_types=1);

namespace Thn\BackendTest\Infrastructure\Delivery\Response\JsonApi\Transformer;

use Thn\BackendTest\Application\Query\Room\RoomGet\GetRoomQueryResponse;
use Thn\BackendTest\Domain\Model\Hotel\Hotel;
use Thn\BackendTest\Domain\Query\QueryResponse;

class JsonApiHotelTransformer extends JsonApiTransformer
{
    protected $availableIncludes = [
        'rooms'
    ];

    protected $defaultIncludes = [];

    public function __construct(string $typeName)
    {
        parent::__construct();
        $this->typeName = $typeName;
    }

    public function responseSingleResult($data, array $includes = []): array
    {
        if (true === empty($data)) {
            return [];
        }

        $result =  [
            'id' => $data->id()->value(),
            'name' => $data->name()->value(),
            'city' => $data->city()->value(),
            'country' => $data->country()->value(),
            'phone' => $data->phone()->value(),
            'email' => $data->email()->value(),
        ];

        $result = $this->includeRooms($result, $data, $includes);

        return $result;
    }

    public function includeRooms(array $data, Hotel $hotel, array $includes) :array
    {
        if (true === in_array('rooms', $includes) && false === empty($hotel->rooms())) {
            foreach ($hotel->rooms()->toArray() as $room){
                $transformer = new JsonApiRoomTransformer('rooms');
                $qr = new GetRoomQueryResponse($room, []);
                $data['rooms'][] =  $transformer->transform($qr);
            }
        }

        return $data;
    }
}
