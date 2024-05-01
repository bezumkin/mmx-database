<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use MMX\Database\Models\Casts\Serialize;

/**
 * @property int $id
 * @property int $source
 * @property bool $property_preprocess
 * @property string $name
 * @property string $description
 * @property int $editor_type
 * @property int $category
 * @property bool $cache_type
 * @property string $snippet
 * @property bool $locked
 * @property array $properties
 * @property string $moduleguid
 * @property bool $static
 * @property string $static_file
 */
class Snippet extends Model
{
    use Traits\StaticElement;

    public $timestamps = false;
    protected $table = 'site_snippets';
    protected $guarded = ['id'];
    protected $casts = [
        'property_preprocess' => 'bool',
        'cache_type' => 'bool',
        'locked' => 'bool',
        'properties' => Serialize::class,
        'static' => 'bool',
    ];
    protected string $contentField = 'snippet';
}