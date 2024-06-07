<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MMX\Database\App;
use MODX\Revolution\modUserGroupSetting;
use xPDO\Om\xPDOObject;

/**
 * @property int $group
 * @property string $key
 * @property string $value
 * @property string $xtype
 * @property string $namespace
 * @property string $area
 * @property string $editedon
 *
 * @property-read UserGroup $Group
 */
class UserGroupSetting extends Model
{
    use Traits\CompositeKey;

    public $timestamps = false;
    protected $primaryKey = ['group', 'key'];
    protected $table = 'user_group_settings';
    protected $guarded = ['group', 'key'];
    protected $casts = [
        'editedon' => 'datetime:Y-m-d H:i:s',
    ];

    public function getModxObject(): ?xPDOObject
    {
        return App::getModx()
            ->getObject(modUserGroupSetting::class, array_combine($this->primaryKey, [$this->group, $this->key]));
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

    public function UserGroup(): BelongsTo
    {
        return $this->belongsTo(UserGroup::class, 'group');
    }
}