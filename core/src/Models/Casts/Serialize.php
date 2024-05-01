<?php

namespace MMX\Database\Models\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Serialize implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): array
    {
        return unserialize($value, ['allowed_classes' => []]);
    }

    public function set($model, string $key, $value, array $attributes): string
    {
        return serialize($value);
    }
}