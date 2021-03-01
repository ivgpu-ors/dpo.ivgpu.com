<?php

namespace App\Casts;

use App\Enums\OrderStatus;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class OrderStatusCast implements CastsAttributes
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
    public function get($model, $key, $value, $attributes): OrderStatus
    {
        return new OrderStatus($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param Model $model
     * @param string $key
     * @param OrderStatus $value
     * @param array $attributes
     * @return integer
     */
    public function set($model, $key, $value, $attributes)
    {
        return $value->value;
    }
}
