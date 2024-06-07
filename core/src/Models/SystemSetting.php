<?php

namespace MMX\Database\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MMX\Database\App;
use MODX\Revolution\modSystemSetting;
use xPDO\Om\xPDOObject;

/**
 * @property string $key
 * @property string $value
 * @property string $xtype
 * @property string $namespace
 * @property string $area
 * @property Carbon $editedon
 *
 * @property-read Namespaces $Namespace
 */
class SystemSetting extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'key';
    protected $table = 'system_settings';
    protected $guarded = ['key'];
    protected $casts = [
        'editedon' => 'datetime:Y-m-d H:i:s',
    ];

    public function getModxObject(): ?xPDOObject
    {
        return App::getModx()->getObject(modSystemSetting::class, $this->key);
    }

    public function Namespace(): BelongsTo
    {
        return $this->belongsTo(Namespaces::class, 'namespace');
    }
}
