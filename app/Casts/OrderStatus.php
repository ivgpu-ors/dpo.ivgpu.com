<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class OrderStatus implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param Model $model
     * @param string $key
     * @param integer $value
     * @param array $attributes
     * @return mixed
     */
    public function get($model, $key, $value, $attributes): \App\Enums\OrderStatus
    {
        return new \App\Enums\OrderStatus($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param Model $model
     * @param string $key
     * @param \App\Enums\OrderStatus $value
     * @param array $attributes
     * @return integer
     */
    public function set($model, $key, $value, $attributes)
    {
        return $value->value;
    }
}
