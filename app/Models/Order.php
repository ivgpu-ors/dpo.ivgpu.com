<?php

namespace App\Models;

use App\Casts\OrderStatusCast;
use App\Enums\OrderStatus;
use App\Events\OrderPayed;
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
 * @property OrderStatus $status
 * @property string|null $external_id
 * @property string|null $pay_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Course $course
 * @property-read Option $option
 * @property-read User $user
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @mixin \Eloquent
 */
class Order extends Model
{
    protected $fillable = ['user_id', 'course_id', 'option_id'];

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
        'status' => OrderStatusCast::class
    ];

    public function pay()
    {
        $this->status = OrderStatus::paid();
        if ($this->save()) {
            event(new OrderPayed($this));
        }

    }
}
