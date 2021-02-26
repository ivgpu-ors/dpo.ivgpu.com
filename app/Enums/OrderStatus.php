<?php


namespace App\Enums;


use Spatie\Enum\Enum;

/**
 * @method static self draft()
 * @method static self paid()
 */
class OrderStatus extends Enum
{
    protected static function values(): array
    {
        return [
            'draft' => 0,
            'paid' => 1,
        ];
    }
}
