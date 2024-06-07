<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MMX\Database\App;
use MODX\Revolution\modUserGroupRole;
use xPDO\Om\xPDOObject;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $authority
 *
 * @property-read UserGroupMember[] $Members
 */
class UserGroupRole extends Model
{
    public $timestamps = false;
    protected $table = 'user_group_roles';
    protected $guarded = ['id'];

    public function getModxObject(): ?xPDOObject
    {
        return App::getModx()->getObject(modUserGroupRole::class, $this->id);
    }

    public function Members(): HasMany
    {
        return $this->hasMany(UserGroupMember::class, 'role');
    }
}