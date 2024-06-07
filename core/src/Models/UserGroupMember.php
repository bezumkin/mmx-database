<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MMX\Database\App;
use MODX\Revolution\modUserGroupMember;
use xPDO\Om\xPDOObject;

/**
 * @property int $id
 * @property int $user_group
 * @property int $member
 * @property int $role
 * @property int $rank
 *
 * @property-read User $User
 * @property-read UserGroup $Group
 * @property-read UserGroupRole $Role
 */
class UserGroupMember extends Model
{
    public $timestamps = false;
    protected $table = 'member_groups';
    protected $guarded = ['id'];

    public function getModxObject(): ?xPDOObject
    {
        return App::getModx()->getObject(modUserGroupMember::class, $this->id);
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'member');
    }

    public function Group(): BelongsTo
    {
        return $this->belongsTo(UserGroup::class, 'user_group');
    }

    public function Role(): BelongsTo
    {
        return $this->belongsTo(UserGroupRole::class, 'role');
    }
}