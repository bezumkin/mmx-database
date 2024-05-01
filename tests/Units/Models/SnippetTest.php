<?php

namespace MMX\Database\Tests\Units\Models;

use MMX\Database\Models\Snippet;
use MMX\Database\Tests\Units\ElementCase;

class SnippetTest extends ElementCase
{
    protected string $model = Snippet::class;
    protected string $contentField = 'snippet';
}