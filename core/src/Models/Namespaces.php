<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MMX\Database\App;
use MODX\Revolution\modNamespace;
use xPDO\Om\xPDOObject;

/**
 * @property string name
 * @property string path
 * @property string assets_path
 *
 * @property-read Menu[] $Menus
 * @property-read SystemSetting[] $SystemSettings
 * @property-read ContextSetting[] $ContextSettings
 */
class Namespaces extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'namespaces';
    protected $primaryKey = 'name';

    public function getModxObject(): ?xPDOObject
    {
        return App::getModx()->getObject(modNamespace::class, $this->name);
    }

    public function Menus(): HasMany
    {
        return $this->hasMany(Menu::class, 'namespace');
    }

    public function SystemSettings(): HasMany
    {
        return $this->hasMany(SystemSetting::class, 'namespace');
    }

    public function ContextSettings(): HasMany
    {
        return $this->hasMany(ContextSetting::class, 'namespace');
    }
}