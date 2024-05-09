<?php

namespace MMX\Database\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function Namespace(): BelongsTo
    {
        return $this->belongsTo(Namespaces::class, 'namespace');
    }
}
