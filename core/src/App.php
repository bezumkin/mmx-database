<?php

namespace MMX\Database;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Events\Dispatcher;
use MODX\Revolution\modX;

class App extends Manager
{
    public const NAME = 'mmxDatabase';
    public const NAMESPACE = 'mmx-database';

    public function __construct(modX $modx)
    {
        parent::__construct();

        $config = $modx->getConnection()->config;
        $this->addConnection([
            'driver' => $config['dbtype'],
            'host' => $config['host'],
            'port' => $config['port'] ?? '3306',
            'prefix' => $config['table_prefix'],
            'database' => $config['dbname'],
            'username' => $config['username'],
            'password' => $config['password'],
            'charset' => $config['charset'],
            'collation' => $config['charset'] . '_general_ci',
            'foreign_key_constraints' => false,
        ]);

        $this->setEventDispatcher(new Dispatcher());
        $this->setAsGlobal();
        $this->bootEloquent();

        $this->getDatabaseManager()->listen(function (QueryExecuted $event) use ($modx) {
            $time = ($event->time / 1000);
            $modx->executedQueries++;
            $modx->queryTime += $time;
            $modx->log(modX::LOG_LEVEL_INFO, '[mmxDatabase] ' . $event->sql . '; ' . $time . ' s');
        });
    }
}