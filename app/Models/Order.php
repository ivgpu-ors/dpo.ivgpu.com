<?php

namespace App\Models;

use App\Casts\OrderStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property string $user_id
 * @property int $course_id
 * @property int $option_id
 * @property int $price
 * @property \App\Enums\OrderStatus $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\Course $course
 * @property-read \App\Models\Option $option
 * @property-read \App\Models\User $user
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @mixin \Eloquent
 */
class Order extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class);
    }

    protected $casts = [
        'status' => OrderStatus::class
    ];
}
