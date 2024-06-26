<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use MMX\Database\App;
use MODX\Revolution\modUser;
use xPDO\Om\xPDOObject;

/**
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $cachepwd
 * @property string $class_key
 * @property bool $active
 * @property string $remote_key
 * @property string $remote_data
 * @property string $hash_class
 * @property string $salt
 * @property int $primary_group
 * @property string $session_stale
 * @property bool $sudo
 * @property string $createdon
 *
 * @property-read UserProfile $Profile
 * @property-read UserGroup $Group
 * @property-read UserSetting[] $Settings
 * @property-read UserGroupMember[] $Members
 */
class User extends Model
{
    public $timestamps = false;
    protected $table = 'users';
    protected $guarded = ['id'];
    protected $casts = [
        'active' => 'bool',
        'sudo' => 'bool',
        'createdon' => Casts\Timestamp::class,
    ];
    protected $hidden = ['password', 'cachepwd', 'salt'];
    protected $dateFormat = 'U';

    protected static function boot(): void
    {
        parent::boot();

        static::creating(static function (self $model) {
            if (!$model->isDirty('createdon')) {
                $model->createdon = $model->freshTimestamp();
            }
        });
    }

    public function getModxObject(): ?xPDOObject
    {
        return App::getModx()->getObject(modUser::class, $this->id);
    }

    public function Profile(): HasOne
    {
        return $this->hasOne(UserProfile::class, 'internalKey');
    }

    public function Group(): BelongsTo
    {
        return $this->belongsTo(UserGroup::class, 'primary_group');
    }

    public function Settings(): HasMany
    {
        return $this->hasMany(UserSetting::class, 'user');
    }

    public function Members(): HasMany
    {
        return $this->hasMany(UserGroupMember::class, 'member');
    }
}