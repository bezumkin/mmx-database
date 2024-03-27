<?php

namespace MMX\Database\Console;

use MMX\Database\App;
use MMX\Database\Console\Command\Install;
use MMX\Database\Console\Command\Remove;
use MODX\Revolution\modX;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\ListCommand;

class Console extends Application
{
    protected modX $modx;
    protected App $app;

    public function __construct(modX $modx)
    {
        parent::__construct(App::NAME);
        $this->modx = $modx;
        $this->app = new App($modx);
    }

    protected function getDefaultCommands(): array
    {
        return [
            new ListCommand(),
            new Install($this->modx),
            new Remove($this->modx),
        ];
    }
}
