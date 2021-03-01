<?php

namespace App\Models;

use App\Casts\OrderStatusCast;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * App\Models\Order
 *
 * @property string $id
 * @property string $user_id
 * @property int $course_id
 * @property int $option_id
 * @property int $price
 * @property \App\Enums\OrderStatus $status
 * @property string|null $external_id
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
    protected $fillable = ['user_id', 'course_id', 'option_id'];

    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            $post->{$post->getKeyName()} = (string) Str::uuid();
        });
    }

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
}
