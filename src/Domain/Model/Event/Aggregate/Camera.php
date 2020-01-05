<?php
declare(strict_types=1);

namespace ZoiloMora\HikvisionCommunicator\Domain\Model\Event\Aggregate;

final class Camera implements \JsonSerializable
{
    private string $name;
    private string $number;

    private function __construct(string $name, string $number)
    {
        $this->name = $name;
        $this->number = $number;
    }

    public static function from(string $name, string $number): self
    {
        return new self($name, $number);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function number(): string
    {
        return $this->number;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'number' => $this->number,
        ];
    }
}
