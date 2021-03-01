<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Course
 *
 * @property int $id
 * @property string $name
 * @property int|null $image_id
 * @property int $enabled
 * @property Carbon|null $start
 * @property Carbon|null $end
 * @property string $duration
 * @property string $education_time
 * @property string $description
 * @property string $program
 * @property string|null $conditions
 * @property string|null $target_audience
 * @property string $impl_form
 * @property int|null $leader_id
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read bool $active
 * @property-read \App\Models\Image|null $image
 * @property-read \App\Models\Employee|null $leader
 * @property-read Collection|\App\Models\Option[] $options
 * @property-read int|null $options_count
 * @property-read Collection|\App\Models\Employee[] $teachers
 * @property-read int|null $teachers_count
 * @method static Builder|Course active()
 * @method static Builder|Course newModelQuery()
 * @method static Builder|Course newQuery()
 * @method static Builder|Course query()
 * @mixin \Eloquent
 */
class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_id',
        'enabled',
        'start',
        'end',
        'duration',
        'education_time',
        'description',
        'program',
        'conditions',
        'target_audience',
        'impl_form',
        'leader_id',
    ];

    protected $casts = [
        'start' => 'date',
        'end' => 'date',
        'deleted_at' => 'datetime'
    ];

    public function leader(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'leader_id');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class)->using(CourseOption::class)->withPivot('price');
    }

    public function getActiveAttribute(): bool
    {
        return $this->enabled && $this->start ? now()->isBefore($this->start) : true;
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('enabled', true)->where(function (Builder $query) {
            $query->whereNotNull('start')->where('start', '>', now());
        });
    }
}
