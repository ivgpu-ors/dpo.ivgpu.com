<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Option
 *
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
