<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Option
 *
 * @property int $id
 * @property string $name
 * @property array|null $capacities
 * @property string|null $caption
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Option newModelQuery()
 * @method static Builder|Option newQuery()
 * @method static Builder|Option query()
 * @mixin Eloquent
 */
class Option extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'capacities', 'caption', 'price' ];

    protected $casts = [
        'capacities' => 'array',
    ];
}
