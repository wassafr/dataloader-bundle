<?php
/*
 * DataLoaderCommand.php
 *
 * Copyright (C) WASSA SAS - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 *
 * 09/06/2015
 */

namespace Wassa\DataLoaderBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DataLoaderCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('wassa:dataloader:load')
            ->setDescription('Load data')
            ->addArgument('class', InputArgument::REQUIRED, 'Class that will load the data')
            ->addOption('sendmail', null, InputOption::VALUE_NONE, 'Defines if a mail should be sent after data load')
            ->addOption('to', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Recipients of the mail report')
            ->addOption('from', null, InputOption::VALUE_REQUIRED, 'Sender of the mail report');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Get arguments and options
        $dataLoaderClass = $input->getArgument('class');
        $shouldSendMail = $input->getOption('sendmail');
        $to = $input->getOption('to');
        $from = $input->getOption('from');
        $container = $this->getContainer();

        // Get class from shortcurt notation
        list($bundle, $class) = $this->parseShortcutNotation($dataLoaderClass);
        $className = "$bundle\\$class";
        $dataLoader = new $className;

        // Start data loading
        $result = $dataLoader->run();

        // Send mail report if needed
        if ($shouldSendMail) {
            $mailer = $container->get('wassa.dataloader.mailer');
            $mailer->sendMail($result, $from, $to);
        }
    }

    protected function parseShortcutNotation($shortcut)
    {
        $entity = str_replace('/', '\\', $shortcut);

        if (false === $pos = strpos($entity, ':')) {
            throw new \InvalidArgumentException(sprintf('The entity name must contain a : ("%s" given, expecting something like AcmeBlogBundle:Blog/Post)', $entity));
        }

        return array(substr($entity, 0, $pos), substr($entity, $pos + 1));
    }
}