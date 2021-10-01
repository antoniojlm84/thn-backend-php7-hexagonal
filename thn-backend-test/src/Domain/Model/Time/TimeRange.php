<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Time;

class TimeRange
{
    public const FORMAT = 'H:i';

    /** @var Time */
    private $initialTime;

    /** @var Time */
    private $endTime;

    public function __construct(Time $initialTime, Time $endTime)
    {
        $this->initialTime = $initialTime;
        $this->endTime = $endTime;
    }

    public function initialTime(): Time
    {
        return $this->initialTime;
    }

    public function endTime(): Time
    {
        return $this->endTime;
    }
}
