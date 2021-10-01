<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\User\Exception;

use Exception;

class PasswordMismatch extends Exception
{
    private const STATUS_CODE = 400;

    public function __construct($message)
    {
        parent::__construct(
            $message,
            self::STATUS_CODE
        );
    }
}