<?php

namespace RentgenCli\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConfigCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setDescription('Get config.')
            ->addOption('env', null, InputOption::VALUE_REQUIRED, 'Set environment');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $environment = $input->getOption('env');
        $config = $this->getContainer()->get('connection_config');
        if (null !== $environment) {
            $config->changeEnvironment($environment);
        }

        $rows = [['DSN',$config->getDsn()], ['Username', $config->getUsername()], ['Password', $config->getPassword()]];
        $table = $this->getHelperSet()->get('table');
        $table->setRows($rows)->render($output);
    }
}
