<?php
declare(strict_types=1);

namespace ZoiloMora\HikvisionCommunicator\Domain\Model\Event;

use ZoiloMora\HikvisionCommunicator\Domain\Model\Event\Aggregate\Camera;
use ZoiloMora\HikvisionCommunicator\Domain\Model\Event\Aggregate\Device;

final class Event implements \JsonSerializable
{
    private string $type;
    private Device $device;
    private Camera $camera;
    private \DateTime $occurredOn;

    private function __construct(
        string $type,
        Device $device,
        Camera $camera,
        \DateTime $occurredOn
    ) {
        $this->type = $type;
        $this->device = $device;
        $this->camera = $camera;
        $this->occurredOn = $occurredOn;
    }

    public static function from(
        string $type,
        Device $device,
        Camera $camera,
        \DateTime $occurredOn
    ): self {
        return new self(
            $type,
            $device,
            $camera,
            $occurredOn
        );
    }

    public function type(): string
    {
        return $this->type;
    }

    public function device(): Device
    {
        return $this->device;
    }

    public function camera(): Camera
    {
        return $this->camera;
    }

    public function occurredOn(): \DateTime
    {
        return $this->occurredOn;
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => $this->type,
            'device' => $this->device,
            'camera' => $this->camera,
            'occurred_on' => $this->occurredOn->format(\DATE_ISO8601),
        ];
    }
}
