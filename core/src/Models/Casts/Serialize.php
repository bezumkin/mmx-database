<?php

namespace MMX\Database\Models\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Serialize implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return unserialize($value, ['allowed_classes' => []]);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return serialize($value);
    }
}