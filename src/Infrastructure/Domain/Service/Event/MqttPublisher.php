<?php
declare(strict_types=1);

namespace ZoiloMora\HikvisionCommunicator\Infrastructure\Domain\Service\Event;

use Mosquitto\Client;
use ZoiloMora\HikvisionCommunicator\Domain\Model\Event\Event;
use ZoiloMora\HikvisionCommunicator\Domain\Service\Event\Publisher;

final class MqttPublisher implements Publisher
{
    private Client $client;
    private string $topic;

    public function __construct(Client $client, string $topic)
    {
        $this->client = $client;
        $this->topic = $topic;
    }

    public function execute(Event $event): void
    {
        $message = \json_encode($event);
        $this->client->publish($this->topic, $message);
        echo sprintf("Published message: %s\n", $message);
    }
}
