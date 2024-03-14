<?php

namespace MMX\Database\Console;

use MMX\Database\App;
use MMX\Database\Console\Command\Install;
use MMX\Database\Console\Command\Remove;
use Symfony\Component\Console\Application;

class Console extends Application
{
    public function __construct()
    {
        parent::__construct(App::NAME);

        $this->addCommands([
            new Install(),
            new Remove(),
        ]);
    }
}
