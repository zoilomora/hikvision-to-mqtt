<?php
declare(strict_types=1);

namespace ZoiloMora\HikvisionCommunicator\Infrastructure\Service;

use Mosquitto\Client;

final class MQTTClientFactory
{
    public static function build(string $clientId, string $broker, int $port): Client
    {
        // https://mosquitto-php.readthedocs.io/en/latest/client.html#Mosquitto\Client::__construct
        $client = new Client($clientId);

        // https://mosquitto-php.readthedocs.io/en/latest/client.html#Mosquitto\Client::connect
        $client->connect($broker, $port);

        return $client;
    }
}
