<?php

namespace MMX\Database\Models\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MMX\Database\Models\Category;
use MMX\Database\Models\Source;

/**
 * @property bool $static
 * @property int $source
 * @property string $static_file
 * @property string $contentField
 *
 * @property-read Category $Category
 * @property-read Source $Source
 */
trait StaticElement
{
    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category');
    }

    public function Source(): BelongsTo
    {
        return $this->belongsTo(Source::class, 'source');
    }

    public function getStaticFile(): ?string
    {
        if ($this->static && $this->static_file) {
            if ($this->Source && !str_ends_with($this->Source->class_key, 'modFileMediaSource')) {
                return null;
            }

            $base = $this->Source ? $this->Source->getBasePath() : MODX_BASE_PATH;
            $file = $base . $this->static_file;
            if (file_exists($file)) {
                return $file;
            }
        }

        return null;
    }

    public function deleteStaticFile(): bool
    {
        if (($file = $this->getStaticFile()) && unlink($file)) {
            $this->update(['static' => false, 'static_file' => '']);

            return true;
        }

        return false;
    }

    public function getContent(): string
    {
        if ($file = $this->getStaticFile()) {
            return file_get_contents($file);
        }

        return (string)$this->{$this->contentField};
    }
}