<?php

namespace MMX\Database\Models\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class Serialize implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): array
    {
        return unserialize($value, ['allowed_classes' => []]);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        return serialize($value);
    }
}