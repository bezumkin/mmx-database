<?php

namespace MMX\Database\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $context_key
 * @property string $key
 * @property string $value
 * @property string $xtype
 * @property string $namespace
 * @property string $area
 * @property Carbon $editedon
 *
 * @property-read Context $Context
 * @property-read Namespaces $Namespace
 */
class ContextSetting extends Model
{
    use Traits\CompositeKey;

    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = ['context_key', 'key'];
    protected $table = 'context_setting';
    protected $guarded = ['context_key', 'key'];
    protected $casts = [
        'editedon' => 'date',
    ];

    public function Context(): BelongsTo
    {
        return $this->belongsTo(Context::class, 'context_key', 'key');
    }

    public function Namespace(): BelongsTo
    {
        return $this->belongsTo(Namespaces::class, 'namespace');
    }
}
