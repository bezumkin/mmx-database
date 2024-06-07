<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use MMX\Database\App;
use MODX\Revolution\modChunk;
use xPDO\Om\xPDOObject;

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
 */
class Chunk extends Model
{
    use Traits\StaticElement;

    public $timestamps = false;
    protected $table = 'site_htmlsnippets';
    protected $guarded = ['id'];
    protected $casts = [
        'property_preprocess' => 'bool',
        'cache_type' => 'bool',
        'locked' => 'bool',
        'properties' => Casts\Serialize::class,
        'static' => 'bool',
    ];
    protected string $contentField = 'snippet';

    public function getModxObject(): ?xPDOObject
    {
        return App::getModx()->getObject(modChunk::class, $this->id);
    }
}