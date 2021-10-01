<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model;

use DateTimeImmutable;

trait TimeAwareTrait
{
    /** @var DateTimeImmutable */
    protected $createdAt;

    /** @var DateTimeImmutable */
    protected $updatedAt;

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
