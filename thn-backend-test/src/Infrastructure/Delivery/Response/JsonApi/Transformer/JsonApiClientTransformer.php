<?php

declare(strict_types=1);

namespace Thn\BackendTest\Infrastructure\Delivery\Response\JsonApi\Transformer;

use Thn\BackendTest\Application\Query\Room\RoomGet\GetRoomQueryResponse;
use Thn\BackendTest\Domain\Model\Client\Client;

class JsonApiClientTransformer extends JsonApiTransformer
{
    protected $availableIncludes = [];

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

        $result = [
            'id' => $data->id()->value(),
            'name' => $data->name()->value(),
            'email' => $data->email()->value(),
            'countryIso' => $data->countryIso()->value()
        ];

        $result = $this->includeBookedRooms($result, $data);

        return $result;
    }

    public function includeBookedRooms(array $data, Client $client) :array
    {
        if (false === empty($client->rooms())) {
            foreach ($client->rooms()->toArray() as $room){
                $transformer = new JsonApiRoomTransformer('room');
                $qr = new GetRoomQueryResponse($room, []);
                $data['bookedRooms'][] = $transformer->transform($qr);
            }
        }

        return $data;
    }
}
