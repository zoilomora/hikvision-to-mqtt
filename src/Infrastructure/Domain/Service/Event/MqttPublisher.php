<?php
declare(strict_types=1);

namespace ZoiloMora\HikvisionCommunicator\Infrastructure\Domain\Service\Event;

use Mosquitto\Client;
use ZoiloMora\HikvisionCommunicator\Domain\Model\Event\Event;
use ZoiloMora\HikvisionCommunicator\Domain\Service\Event\Publisher;

final class MqttPublisher implements Publisher
{
    private Client $client;
    private string $broker;
    private int $port;
    private string $username;
    private string $password;
    private string $topic;

    public function __construct(
        Client $client,
        string $broker,
        int $port,
        string $username,
        string $password,
        string $topic
    ) {
        $this->client = $client;
        $this->broker = $broker;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->topic = $topic;
    }

    public function execute(Event $event): void
    {
        $message = \json_encode($event);

        if ('' !== $this->username && '' !== $this->password) {
            // https://mosquitto-php.readthedocs.io/en/latest/client.html#Mosquitto\Client::setCredentials
            $this->client->setCredentials($this->username, $this->password);
        }

        // https://mosquitto-php.readthedocs.io/en/latest/client.html#Mosquitto\Client::connect
        $this->client->connect($this->broker, $this->port);

        // https://mosquitto-php.readthedocs.io/en/latest/client.html#Mosquitto\Client::publish
        $this->client->publish($this->topic, $message);

        // https://mosquitto-php.readthedocs.io/en/latest/client.html#Mosquitto\Client::disconnect
        $this->client->disconnect();

        echo sprintf("Published message: %s\n", $message);
    }
}
