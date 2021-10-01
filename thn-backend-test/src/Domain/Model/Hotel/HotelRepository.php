<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Hotel;

interface HotelRepository
{
    public function byId(HotelId $HotelId): ?Hotel;

    public function save(Hotel $Hotel): void;

    public function count(): int;
}
