<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MMX\Database\Models\Casts\Timestamp;

/**
 * @property int $id
 * @property int $internalKey
 * @property string $fullname
 * @property string $email
 * @property string $phone
 * @property string $mobilephone
 * @property bool $blocked
 * @property int $blockeduntil
 * @property int $blockedafter
 * @property int $logincount
 * @property int $lastlogin
 * @property int $thislogin
 * @property int $failedlogincount
 * @property string $sessionid
 * @property int $dob
 * @property int $gender
 * @property string $address
 * @property string $country
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $fax
 * @property string $photo
 * @property string $comment
 * @property string $website
 * @property array $extended
 *
 * @property-read User $User
 */
class UserProfile extends Model
{
    public $timestamps = false;
    protected $table = 'user_attributes';
    protected $casts = [
        'blocked' => 'bool',
        'blockeduntil' => 'int',
        'blockedafter' => 'int',
        'thislogin' => 'int',
        'lastlogin' => 'int',
        'extended' => 'array',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'internalKey');
    }
}