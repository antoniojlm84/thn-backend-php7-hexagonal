<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Time\Exception;

class TimeNotValid extends \Exception
{
    private const STATUS_CODE = 400;

    public function __construct(string $code)
    {
        parent::__construct(
            sprintf(
                'Time not valid %s',
                $code
            ),
            self::STATUS_CODE
        );
    }
}
