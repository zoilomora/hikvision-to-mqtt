<?php
declare(strict_types=1);

namespace ZoiloMora\HikvisionCommunicator\Infrastructure\Domain\Service\Event;

use ZoiloMora\HikvisionCommunicator\Domain\Model\Event\Event;
use ZoiloMora\HikvisionCommunicator\Domain\Service\Event\Publisher;

class MqttPublisher implements Publisher
{
    public function execute(Event $event): void
    {
        echo sprintf(
            "Publish: %s\n",
            json_encode($event)
        );
    }
}
