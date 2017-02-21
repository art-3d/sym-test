<?php

namespace ArtTestBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class RemoveCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('guestbook:remove')
            ->setDescription('Removes N guestbook rows')
            ->addArgument('count', InputArgument::REQUIRED, 'Count of rows that need to be removed');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $count = $input->getArgument('count');

        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $em->getRepository('ArtTestBundle:GuestBook')
            ->removeRows($count);

        $output->writeln("<info>Old $count row(s) have been removed</info>");
    }
}
