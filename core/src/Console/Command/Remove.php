<?php

namespace MMX\Database\Console\Command;

use MMX\Database\App;
use MMX\Database\Models\Namespaces;
use MODX\Revolution\modX;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Remove extends Command
{
    protected static $defaultName = 'remove';
    protected static $defaultDescription = 'Remove mmxDatabase extra from MODX 3';
    protected modX $modx;

    public function __construct(modX $modx, ?string $name = null)
    {
        parent::__construct($name);
        $this->modx = $modx;
    }

    public function run(InputInterface $input, OutputInterface $output): void
    {
        $corePath = MODX_CORE_PATH . 'components/' . App::NAMESPACE;

        if (is_dir($corePath)) {
            unlink($corePath);
            $output->writeln('<info>Removed symlink for "core"</info>');
        }

        if ($namespace = Namespaces::query()->where('name', App::NAMESPACE)->first()) {
            $namespace->delete();
            $output->writeln('<info>Removed namespace "' . App::NAMESPACE . '"</info>');
        }

        $this->modx->getCacheManager()->refresh();
        $output->writeln('<info>Cleared MODX cache</info>');
    }
}
