<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Hotel\Exception;

use Thn\BackendTest\Domain\Model\Hotel\HotelId;

final class HotelNotFound extends \Exception
{
    private const STATUS_CODE = 404;

    public function __construct(HotelId $clientId)
    {
        parent::__construct(
            sprintf(
                'Hotel with id: %s not found.',
                $clientId->value()
            ),
            self::STATUS_CODE
        );
    }
}
