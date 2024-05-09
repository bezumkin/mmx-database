<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use MMX\Database\Models\Casts\Timestamp;

/**
 * @property int $id
 * @property string $type
 * @property string $pagetitle
 * @property string $longtitle
 * @property string $description
 * @property string $alias
 * @property string $link_attributes
 * @property bool $published
 * @property string $pub_date
 * @property string $unpub_date
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
 * @property string $createdon
 * @property int $editedby
 * @property string $editedon
 * @property bool $deleted
 * @property string $deletedon
 * @property int $deletedby
 * @property string $publishedon
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
 * @property-read TV[] $Tvs
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
        'createdon' => Timestamp::class,
        'editedon' => Timestamp::class,
        'deletedon' => Timestamp::class,
        'publishedon' => Timestamp::class,
        'pub_date' => Timestamp::class,
        'unpub_date' => Timestamp::class,
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

    public function Tvs(): HasManyThrough
    {
        return $this->hasManyThrough(TV::class, TVResource::class, 'contentid', 'id', 'id', 'tmplvarid');
    }
}