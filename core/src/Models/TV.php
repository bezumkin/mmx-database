<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property int $id
 * @property int $source
 * @property string $type
 * @property string $name
 * @property string $caption
 * @property string $description
 * @property int $category
 * @property string $display
 * @property string $default_text
 * @property bool $static
 * @property string $static_file
 *
 * @property-read Resource $Resources
 * @property-read TVResource $ResourceValues
 * @property-read Category $Category
 */
class TV extends Model
{
    public $timestamps = false;
    protected $table = 'site_tmplvars';
    protected $casts = [
        'active' => 'boolean',
    ];

    public function ResourceValues(): HasMany
    {
        return $this->hasMany(TVResource::class, 'tmplvarid');
    }

    public function Resources(): HasManyThrough
    {
        return $this->HasManyThrough(Resource::class, TVResource::class, 'tmplvarid', 'id', 'id', 'contentid');
    }

    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category');
    }
}