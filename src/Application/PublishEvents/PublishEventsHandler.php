<?php
declare(strict_types=1);

namespace ZoiloMora\HikvisionCommunicator\Application\PublishEvents;

use ZoiloMora\HikvisionCommunicator\Domain\Model\Event\EventRepository;
use ZoiloMora\HikvisionCommunicator\Domain\Service\Event\Publisher;

final class PublishEventsHandler
{
    private EventRepository $eventRepository;
    private Publisher $publisher;

    public function __construct(EventRepository $eventRepository, Publisher $publisher)
    {
        $this->eventRepository = $eventRepository;
        $this->publisher = $publisher;
    }

    public function execute(PublishEventsCommand $command): void
    {
        $events = $this->eventRepository->getAll();

        foreach ($events as $event) {
            $this->publisher->execute($event);
        }

        $this->eventRepository->deleteAll();
    }
}
