<?php

namespace MMX\Database\Tests\Units\Models;

use MMX\Database\Models\Chunk;
use MMX\Database\Tests\Units\ElementCase;

class ChunkTest extends ElementCase
{
    protected string $model = Chunk::class;
    protected string $contentField = 'snippet';
}