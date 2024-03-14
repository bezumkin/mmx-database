<?php

namespace MMX\Database\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property int $id
 * @property string $type
 * @property string $pagetitle
 * @property string $longtitle
 * @property string $description
 * @property string $alias
 * @property string $link_attributes
 * @property bool $published
 * @property Carbon $pub_date
 * @property Carbon $unpub_date
 * @property int $parent
 * @property bool $isfolder
 * @property string $introtext
 * @property string $content
 * @property bool $richtext
 * @property int $template
 * @property int $menuindex
 * @property bool $searchable
 * @property bool $cacheable
 * @property int $createdby
 * @property Carbon $createdon
 * @property int $editedby
 * @property Carbon $editedon
 * @property bool $deleted
 * @property Carbon $deletedon
 * @property int $deletedby
 * @property Carbon $publishedon
 * @property int $publishedby
 * @property string $menutitle
 * @property bool $donthit
 * @property bool $privateweb
 * @property bool $privatemgr
 * @property int $content_dispo
 * @property bool $hidemenu
 * @property string $class_key
 * @property string $context_key
 * @property int $content_type
 * @property string $uri
 * @property bool $uri_override
 * @property bool $hide_children_in_tree
 * @property bool $show_in_tree
 * @property array $properties
 * @property bool $alias_visible
 *
 * @property-read self $Parent
 * @property-read self[] $Children
 * @property-read Context $Context
 * @property-read Template $Template
 * @property-read TVResource[] $TvResources
 * @property-read TVResource[] $TvValues
 * @property-read TV[] $TVs
 */
class Resource extends Model
{
    protected $table = 'site_content';
    protected $guarded = ['id'];
    protected $casts = [
        'published' => 'bool',
        'isfolder' => 'bool',
        'richtext' => 'bool',
        'searchable' => 'bool',
        'cacheable' => 'bool',
        'deleted' => 'bool',
        'donthit' => 'bool',
        'privateweb' => 'bool',
        'privatemgr' => 'bool',
        'hidemenu' => 'bool',
        'uri_override' => 'bool',
        'hide_children_in_tree' => 'bool',
        'show_in_tree' => 'bool',
        'alias_visible' => 'bool',
        'properties' => 'array',
        'createdon' => 'date',
        'editedon' => 'date',
        'deletedon' => 'date',
        'publishedon' => 'date',
        'pub_date' => 'date',
        'unpub_date' => 'date',
    ];
    protected $dateFormat = 'U';
    const CREATED_AT = 'createdon';
    const UPDATED_AT = 'editedon';

    public function Parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent');
    }

    public function Children(): HasMany
    {
        return $this->hasMany(self::class, 'parent');
    }

    public function Context(): BelongsTo
    {
        return $this->belongsTo(Context::class, 'context_key', 'key');
    }

    public function Template(): BelongsTo
    {
        return $this->belongsTo(Template::class, 'template');
    }

    public function TvResources(): HasMany
    {
        return $this->hasMany(TVResource::class, 'contentid');
    }

    public function TvValues(): HasMany
    {
        return $this->TVResources();
    }

    public function TVs(): HasManyThrough
    {
        return $this->hasManyThrough(TV::class, TVResource::class, 'contentid', 'id', 'id', 'tmplvarid');
    }
}