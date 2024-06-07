<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use MMX\Database\App;
use MODX\Revolution\modResourceGroup;
use xPDO\Om\xPDOObject;

/**
 * @property int $id
 * @property string $name
 * @property int $private_memgroup
 * @property int $private_webgroup
 *
 */
class ResourceGroup extends Model
{
    public $timestamps = false;
    protected $table = 'documentgroup_names';
    protected $guarded = ['id'];

    public function getModxObject(): ?xPDOObject
    {
        return App::getModx()->getObject(modResourceGroup::class, $this->id);
    }
}