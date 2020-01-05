<?php
declare(strict_types=1);

namespace ZoiloMora\HikvisionCommunicator\Entrypoint\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ZoiloMora\HikvisionCommunicator\Application\PublishEvents\PublishEventsCommand;
use ZoiloMora\HikvisionCommunicator\Application\PublishEvents\PublishEventsHandler;

final class PublishEvents extends Command
{
    private PublishEventsHandler $handler;

    public function __construct(PublishEventsHandler $handler)
    {
        parent::__construct();

        $this->handler = $handler;
    }

    protected function configure()
    {
        $this->setName('app:event:publish-all');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        while (true) {
            $this->handler->execute(
                PublishEventsCommand::create()
            );

            sleep(1);
        }

        return 0;
    }
}
