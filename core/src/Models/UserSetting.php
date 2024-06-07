<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MMX\Database\App;
use MODX\Revolution\modUserProfile;
use xPDO\Om\xPDOObject;

/**
 * @property int $user
 * @property string $key
 * @property string $value
 * @property string $xtype
 * @property string $namespace
 * @property string $area
 * @property string $editedon
 *
 * @property-read User $User
 */
class UserSetting extends Model
{
    use Traits\CompositeKey;

    public $timestamps = false;
    protected $primaryKey = ['user', 'key'];
    protected $table = 'user_settings';
    protected $guarded = ['user', 'key'];
    protected $casts = [
        'editedon' => 'datetime:Y-m-d H:i:s',
    ];

    public function getModxObject(): ?xPDOObject
    {
        return App::getModx()
            ->getObject(modUserProfile::class, array_combine($this->primaryKey, [$this->user, $this->key]));
    }

    protected static function boot(): void
    {
        parent::boot();

        static::saving(static function (self $model) {
            if (!$model->isDirty('editedon')) {
                $model->editedon = $model->freshTimestamp();
            }
        });
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user');
    }
}