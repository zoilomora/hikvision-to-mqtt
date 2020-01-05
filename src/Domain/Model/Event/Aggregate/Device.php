<?php
declare(strict_types=1);

namespace ZoiloMora\HikvisionCommunicator\Domain\Model\Event\Aggregate;

final class Device implements \JsonSerializable
{
    private string $name;
    private string $serialNumber;

    private function __construct(string $name, string $serialNumber)
    {
        $this->name = $name;
        $this->serialNumber = $serialNumber;
    }

    public static function from(string $name, string $serialNumber): self
    {
        return new self($name, $serialNumber);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function serialNumber(): string
    {
        return $this->serialNumber;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'serial_number' => $this->serialNumber,
        ];
    }
}
