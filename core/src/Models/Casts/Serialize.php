<?php

namespace MMX\Database\Models\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Serialize implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return $value ? unserialize($value, ['allowed_classes' => []]) : null;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return serialize($value);
    }
}