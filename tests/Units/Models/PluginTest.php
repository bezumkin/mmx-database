<?php

namespace MMX\Database\Tests\Units\Models;

use MMX\Database\Models\Plugin;
use MMX\Database\Tests\Units\ElementCase;

class PluginTest extends ElementCase
{
    protected string $model = Plugin::class;
    protected string $contentField = 'plugincode';
}