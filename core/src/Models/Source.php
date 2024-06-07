<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MMX\Database\App;
use MODX\Revolution\Sources\modMediaSource;
use xPDO\Om\xPDOObject;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $class_key
 * @property array $properties
 * @property bool $is_stream
 *
 * @property-read Template[] $Templates
 * @property-read Plugin[] $Plugins
 * @property-read Snippet[] $Snippets
 * @property-read Chunk[] $Chunks
 * @property-read TV[] $Tvs
 */
class Source extends Model
{
    protected $table = 'media_sources';
    protected $casts = [
        'properties' => Casts\Serialize::class,
        'is_stream' => 'bool',
    ];

    public function getModxObject(): ?xPDOObject
    {
        return App::getModx()->getObject(modMediaSource::class, $this->id);
    }

    public function Templates(): HasMany
    {
        return $this->hasMany(Template::class);
    }

    public function Plugins(): HasMany
    {
        return $this->hasMany(Plugin::class);
    }

    public function Snippets(): HasMany
    {
        return $this->hasMany(Snippet::class);
    }

    public function Chunks(): HasMany
    {
        return $this->hasMany(Chunk::class);
    }

    public function Tvs(): HasMany
    {
        return $this->hasMany(TV::class);
    }

    public function getBasePath(): string
    {
        return MODX_BASE_PATH;
    }
}