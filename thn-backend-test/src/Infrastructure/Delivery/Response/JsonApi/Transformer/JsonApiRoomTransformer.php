<?php

declare(strict_types=1);

namespace Thn\BackendTest\Infrastructure\Delivery\Response\JsonApi\Transformer;

use Thn\BackendTest\Domain\Query\QueryResponse;

class JsonApiRoomTransformer extends JsonApiTransformer
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

        return [
            'id' => $data->id()->value(),
            'roomNumber' => $data->roomNumber()->value(),
            'floor' => $data->floor()->value(),
            'description' => $data->description()->value()
        ];
    }
}
