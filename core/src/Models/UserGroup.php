<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MMX\Database\App;
use MODX\Revolution\modUserGroup;
use xPDO\Om\xPDOObject;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $parent
 * @property int $rank
 * @property int $dasboard
 *
 * @property-read self $Parent
 * @property-read self[] $Children
 * @property-read UserGroupMember[] $Members
 */
class UserGroup extends Model
{
    public $timestamps = false;
    protected $table = 'membergroup_names';
    protected $guarded = ['id'];

    public function getModxObject(): ?xPDOObject
    {
        return App::getModx()->getObject(modUserGroup::class, $this->id);
    }

    public function Parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent');
    }

    public function Children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent');
    }

    public function Members(): HasMany
    {
        return $this->hasMany(UserGroupMember::class, 'user_group');
    }
}