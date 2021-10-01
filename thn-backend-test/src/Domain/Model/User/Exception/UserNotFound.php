<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\User\Exception;

use Thn\BackendTest\Domain\Exception\DomainException;
use Thn\BackendTest\Domain\Model\User\UserId;

final class UserNotFound extends DomainException
{
    private const STATUS_CODE = 404;

    public function __construct(?UserId $userId = null)
    {
        $message = null !== $userId ?
            sprintf('The user with id %s not found.', $userId->value()) : 'User not found.';

        parent::__construct(
            $message,
            self::STATUS_CODE
        );
    }
}
