<?php

namespace MMX\Database\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
 * @property Carbon $createdon
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
        'createdon' => 'date',
    ];
    protected $dateFormat = 'U';

    public function Profile(): HasOne
    {
        return $this->hasOne(UserProfile::class, 'internalKey');
    }
}