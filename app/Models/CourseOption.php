<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\CourseOption
 *
 * @property int $id
 * @property int $course_id
 * @property int $option_id
 * @property int $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CourseOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseOption query()
 * @mixin \Eloquent
 */
class CourseOption extends Pivot
{
    public $incrementing = true;
}
