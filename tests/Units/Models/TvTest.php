<?php

namespace MMX\Database\Tests\Units\Models;

use MMX\Database\Models\Traits\StaticElement;
use MMX\Database\Models\TV;
use MMX\Database\Tests\Units\ElementCase;

class TvTest extends ElementCase
{
    protected string $model = TV::class;
    protected string $contentField = 'default_text';
}