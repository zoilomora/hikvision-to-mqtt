<?php
declare(strict_types=1);

namespace ZoiloMora\HikvisionCommunicator\Application\PublishEvents;

final class PublishEventsCommand
{
    private function __construct()
    {
    }

    public static function create(): self
    {
        return new self();
    }
}
