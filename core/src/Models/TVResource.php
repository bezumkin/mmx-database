<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MMX\Database\App;
use MODX\Revolution\modTemplateVarResource;
use xPDO\Om\xPDOObject;

/**
 * @property int $id
 * @property int $tmplvarid
 * @property int $contentid
 * @property string $value
 *
 * @property-read Resource $Resource
 * @property-read TV $TV
 */
class TVResource extends Model
{
    public $timestamps = false;
    protected $table = 'site_tmplvar_contentvalues';
    protected $guarded = ['id'];

    public function getModxObject(): ?xPDOObject
    {
        return App::getModx()->getObject(modTemplateVarResource::class, $this->id);
    }

    public function Resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class, 'contentid');
    }

    public function TV(): BelongsTo
    {
        return $this->belongsTo(TV::class, 'tmplvarid');
    }
}