<?php
declare(strict_types=1);

namespace ZoiloMora\HikvisionCommunicator\Domain\Service\Event;

use ZoiloMora\HikvisionCommunicator\Domain\Model\Event\Event;

interface Publisher
{
    public function execute(Event $event): void;
}
