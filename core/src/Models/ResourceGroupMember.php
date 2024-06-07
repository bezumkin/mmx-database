<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use MMX\Database\App;
use MODX\Revolution\modResourceGroupResource;
use xPDO\Om\xPDOObject;

/**
 * @property int $id
 * @property int $document_group
 * @property int $document
 *
 */
class ResourceGroupMember extends Model
{
    public $timestamps = false;
    protected $table = 'document_groups';
    protected $guarded = ['id'];

    public function getModxObject(): ?xPDOObject
    {
        return App::getModx()->getObject(modResourceGroupResource::class, $this->id);
    }
}