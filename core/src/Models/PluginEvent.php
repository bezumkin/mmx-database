<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MMX\Database\App;
use MODX\Revolution\modPluginEvent;
use xPDO\Om\xPDOObject;

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

    public function getModxObject(): ?xPDOObject
    {
        return App::getModx()
            ->getObject(modPluginEvent::class, array_combine($this->primaryKey, [$this->pluginid, $this->event]));
    }

    public function Plugin(): BelongsTo
    {
        return $this->belongsTo(Plugin::class, 'pluginid');
    }
}