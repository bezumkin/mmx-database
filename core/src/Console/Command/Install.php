<?php

namespace MMX\Database\Console\Command;

use MMX\Database\App;
use MMX\Database\Models\Namespaces;
use MODX\Revolution\modX;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Install extends Command
{

    protected static $defaultName = 'install';
    protected static $defaultDescription = 'Install mmxDatabase extra for MODX 3';

    public function run(InputInterface $input, OutputInterface $output): void
    {
        $srcPath = MODX_CORE_PATH . 'vendor/' . str_replace('-', '/', App::NAMESPACE);
        $corePath = MODX_CORE_PATH . 'components/' . App::NAMESPACE;

        if (!is_dir($corePath)) {
            symlink($srcPath . '/core', $corePath);
            $output->writeln('<info>Created symlink for "core"</info>');
        }

        if (!Namespaces::query()->find(App::NAMESPACE)) {
            $namespace = new Namespaces();
            $namespace->name = App::NAMESPACE;
            $namespace->path = '{core_path}components/' . App::NAMESPACE . '/';
            $namespace->save();
            $output->writeln('<info>Created namespace "' . App::NAMESPACE . '"</info>');
        }

        /** @var modX $modx */
        global $modx;
        $modx->getCacheManager()->refresh();
        $output->writeln('<info>Cleared MODX cache</info>');
    }
}
