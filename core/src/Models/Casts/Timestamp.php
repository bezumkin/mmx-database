<?php

namespace MMX\Database\Models\Casts;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Timestamp implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        if ($value) {
            if (!is_numeric($value)) {
                $value = strtotime($value);
            }

            return Carbon::createFromTimestamp($value)->format('Y-m-d H:i:s');
        }

        return 0;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}