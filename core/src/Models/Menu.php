<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $text
 * @property string $parent
 * @property string $action
 * @property string $description
 * @property string $icon
 * @property int $menuindex
 * @property string $params
 * @property string $handler
 * @property string $permissions
 * @property string $namespace
 *
 * @property-read self $Parent
 * @property-read self[] $Children
 * @property-read Namespaces $Namespace
 */
class Menu extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'menus';
    protected $primaryKey = 'text';
    protected $attributes = [
        'params' => '',
        'handler' => '',
        'permissions' => '',
    ];

    public function Parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent');
    }

    public function Children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent');
    }

    public function Namespace(): BelongsTo
    {
        return $this->belongsTo(Namespaces::class, 'namespace');
    }
}