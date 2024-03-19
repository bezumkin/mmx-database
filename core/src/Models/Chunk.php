<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
 * @property bool $static
 * @property string $static_file
 *
 * @property-read Category $Category
 */
class Chunk extends Model
{
    public $timestamps = false;
    protected $table = 'site_htmlsnippets';
    protected $guarded = ['id'];
    protected $casts = [
        'property_preprocess' => 'bool',
        'cache_type' => 'bool',
        'locked' => 'bool',
        'properties' => Serialize::class,
        'static' => 'bool',
    ];

    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category');
    }
}