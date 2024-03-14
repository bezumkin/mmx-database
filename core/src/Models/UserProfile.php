<?php

namespace MMX\Database\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $internalKey
 * @property string $fullname
 * @property string $email
 * @property string $phone
 * @property string $mobilephone
 * @property bool $blocked
 * @property Carbon $blockeduntil
 * @property Carbon $blockedafter
 * @property int $logincount
 * @property Carbon $lastlogin
 * @property Carbon $thislogin
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
    protected $table = 'user_attributes';
    protected $casts = [
        'blocked' => 'bool',
        'blockeduntil' => 'date',
        'blockedafter' => 'date',
        'thislogin' => 'date',
        'lastlogin' => 'date',
        'extended' => 'array',
    ];
    protected $dateFormat = 'U';

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'internalKey');
    }
}