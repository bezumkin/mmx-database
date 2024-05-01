<?php

namespace MMX\Database\Tests\Units\Models;

use MMX\Database\Models\Template;
use MMX\Database\Tests\Units\ElementCase;

class TemplateTest extends ElementCase
{
    protected string $model = Template::class;
    protected string $nameField = 'templatename';
}