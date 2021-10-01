<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model;

use DateTimeImmutable;

trait DeleteTrait
{
    /** @var bool */
    protected $deleted = false;

    /** @var null|\DateTimeImmutable */
    protected $deletedAt;

    public function deleted(): bool
    {
        return $this->deleted;
    }

    public function deletedAt(): ?DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function delete()
    {
        $this->deleted = true;
        $this->deletedAt = new \DateTime('now');
    }
}
