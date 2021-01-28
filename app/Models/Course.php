<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Course
 *
 * @property int $id
 * @property string $name
 * @property int $enabled
 * @property string|null $start
 * @property string|null $end
 * @property string $duration
 * @property string $education_time
 * @property string $description
 * @property string $program
 * @property string|null $conditions
 * @property string|null $target_audience
 * @property string $impl_form
 * @property int|null $leader_id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course query()
 * @mixin \Eloquent
 */
class Course extends Model
{
    use HasFactory;
}
