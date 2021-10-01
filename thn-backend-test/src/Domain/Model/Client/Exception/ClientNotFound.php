<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Client\Exception;

use Thn\BackendTest\Domain\Model\Client\ClientId;
use Thn\BackendTest\Domain\Exception\DomainException;

final class ClientNotFound extends DomainException
{
    private const STATUS_CODE = 404;

    public function __construct(ClientId $clientId)
    {
        parent::__construct(
            sprintf(
                'Client with id: %s not found.',
                $clientId->value()
            ),
            self::STATUS_CODE
        );
    }
}
