<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $parent
 * @property string $category
 * @property int $rank
 *
 * @property-read self $Parent
 * @property-read self[] $Children
 * @property-read Template[] $Templates
 * @property-read Plugin[] $Plugins
 * @property-read Snippet[] $Snippets
 * @property-read Chunk[] $Chunks
 * @property-read TV[] $Tvs
 */
class Category extends Model
{
    public $timestamps = false;
    protected $table = 'categories';

    public function Parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent');
    }

    public function Children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent');
    }

    public function Templates(): HasMany
    {
        return $this->hasMany(Template::class, 'category');
    }

    public function Plugins(): HasMany
    {
        return $this->hasMany(Plugin::class, 'category');
    }

    public function Snippets(): HasMany
    {
        return $this->hasMany(Snippet::class, 'category');
    }

    public function Chunks(): HasMany
    {
        return $this->hasMany(Chunk::class, 'category');
    }

    public function Tvs(): HasMany
    {
        return $this->hasMany(TV::class, 'category');
    }
}