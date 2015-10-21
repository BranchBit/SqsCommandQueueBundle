<?php
namespace BBIT\SqsCommandQueueBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SqsWorkerCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('bbit:sqs-command-queue:work')
            ->setDescription('...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sqsQueueService = $this->getContainer()->get('sqs_queue');
        while(true) {
            $sqsQueueService->processCommand();
        }
    }
}
