<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $source
 * @property bool $property_preprocess
 * @property string $name
 * @property string $description
 * @property int $editor_type
 * @property int $category
 * @property bool $cache_type
 * @property string $plugincode
 * @property bool $locked
 * @property array $properties
 * @property bool $disabled
 * @property string $moduleguid
 * @property bool $static
 * @property string $static_file
 *
 * @property-read Category $Category
 * @property-read PluginEvent[] $Events
 */
class Plugin extends Model
{
    public $timestamps = false;
    protected $table = 'site_plugins';
    protected $guarded = ['id'];
    protected $casts = [
        'property_preprocess' => 'bool',
        'cache_type' => 'bool',
        'locked' => 'bool',
        'properties' => 'array',
        'disabled' => 'bool',
        'static' => 'bool',
    ];

    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category');
    }

    public function Events(): HasMany
    {
        return $this->hasMany(PluginEvent::class, 'pluginid');
    }
}