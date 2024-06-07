<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MMX\Database\App;
use MODX\Revolution\modTemplateVarTemplate;
use xPDO\Om\xPDOObject;

/**
 * @property int $id
 * @property int $tmplvarid
 * @property int $templateid
 * @property int $rank
 *
 * @property-read Template $Template
 * @property-read TV $TV
 */
class TVTemplate extends Model
{
    use Traits\CompositeKey;

    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = ['tmplvarid', 'templateid'];
    protected $table = 'site_tmplvar_templates';
    protected $guarded = [];

    public function getModxObject(): ?xPDOObject
    {
        return App::getModx()->getObject(modTemplateVarTemplate::class, $this->id);
    }

    public function TV(): BelongsTo
    {
        return $this->belongsTo(TV::class, 'tmplvarid');
    }

    public function Template(): BelongsTo
    {
        return $this->belongsTo(Template::class, 'templateid');
    }
}