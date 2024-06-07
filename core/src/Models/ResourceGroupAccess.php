<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use MMX\Database\App;
use MODX\Revolution\modAccessResourceGroup;
use xPDO\Om\xPDOObject;

/**
 * @property string $id
 * @property string $target
 * @property string $principal_class
 * @property int $principal
 * @property int authority
 * @property int policy
 * @property string context_key
 */
class ResourceGroupAccess extends Model
{
    public $timestamps = false;
    protected $table = 'access_resource_groups';
    protected $guarded = ['id'];

    public function getModxObject(): ?xPDOObject
    {
        return App::getModx()->getObject(modAccessResourceGroup::class, $this->id);
    }
}