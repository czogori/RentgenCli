<?php

namespace RentgenCli;

use Symfony\Component\Console\Application;

use RentgenCli\Command\ListTablesCommand;
use RentgenCli\Command\TableInfoCommand;
use RentgenCli\Command\ConfigCommand;
use Rentgen\Rentgen;

class RentgenCliApplication extends Application
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct('Rentgen - Database info and schema manipulation', '0.0.1');

        $rentgen = new Rentgen();
        //$container = $rentgen->getContainer();

        $this->addCommands(array(
            new TableInfoCommand('table', $rentgen),
            new ListTablesCommand('tables', $rentgen),
            new ConfigCommand('config', $rentgen),
        ));
    }
}
