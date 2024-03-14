<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $pluginid
 * @property string $event
 * @property int $priority
 * @property int $propertyset
 *
 * @property-read Plugin $Plugin
 */
class PluginEvent extends Model
{
    use Traits\CompositeKey;

    public $timestamps = false;
    public $incrementing = false;
    protected $table = 'site_plugin_events';
    protected $primaryKey = ['pluginid', 'event'];
    protected $guarded = [];

    public function Plugin(): BelongsTo
    {
        return $this->belongsTo(Plugin::class, 'pluginid');
    }
}