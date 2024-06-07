<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MMX\Database\App;
use MODX\Revolution\modContext;
use xPDO\Om\xPDOObject;

/**
 * @property string $key
 * @property string $name
 * @property string $description
 * @property int $rank
 *
 * @property-read ContextSetting[] $Settings
 * @property-read Resource[] $Resources
 */
class Context extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $table = 'context';
    protected $keyType = 'string';
    protected $guarded = ['key'];

    public function getModxObject(): ?xPDOObject
    {
        return App::getModx()->getObject(modContext::class, $this->key);
    }

    public function Resources(): HasMany
    {
        return $this->hasMany(Resource::class, 'context_key', 'key');
    }

    public function Settings(): HasMany
    {
        return $this->hasMany(ContextSetting::class, 'context_key', 'key');
    }
}