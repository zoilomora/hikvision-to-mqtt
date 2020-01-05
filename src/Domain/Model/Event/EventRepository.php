<?php
declare(strict_types=1);

namespace ZoiloMora\HikvisionCommunicator\Domain\Model\Event;

interface EventRepository
{
    public function getAll(): array;
    public function deleteAll(): void;
}
