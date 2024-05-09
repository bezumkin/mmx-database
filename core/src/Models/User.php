<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use MMX\Database\Models\Casts\Timestamp;

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
 * @property string $primary_group
 * @property string $session_stale
 * @property bool $sudo
 * @property string $createdon
 *
 * @property-read UserProfile $Profile
 */
class User extends Model
{
    public $timestamps = false;
    protected $table = 'users';
    protected $casts = [
        'active' => 'bool',
        'sudo' => 'bool',
        'createdon' => Timestamp::class,
    ];
    protected $dateFormat = 'U';

    protected static function boot(): void
    {
        static::creating(static function (self $model) {
            if (!$model->isDirty('createdon')) {
                $model->createdon = $model->freshTimestamp();
            }
        });
    }

    public function Profile(): HasOne
    {
        return $this->hasOne(UserProfile::class, 'internalKey');
    }
}