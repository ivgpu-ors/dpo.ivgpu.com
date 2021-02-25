<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Image
 *
 * @property int $id
 * @property string $file
 * @property array|null $srcset
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $image_sizes
 * @property-read string $image_src
 * @property-read string $image_srcset
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @mixin Eloquent
 */
class Image extends Model
{
    protected $fillable = ['file', 'srcset'];
    protected $casts = [
        'srcset' => 'array',
    ];

    public function getImageSrcAttribute(): string
    {
        return Storage::url($this->file);
    }

    public function getImageSizesAttribute(): string
    {
        if (! $this->srcset) return '';

        $res = [];
        foreach ($this->srcset as $set) {
            $w = $set['width'];
            $res[] = "(max-width: {$w}px) {$w}px";
        }

        return implode(', ', $res);
    }

    public function getImageSrcsetAttribute(): string
    {
        if (! $this->srcset) return '';

        $res = [];
        foreach ($this->srcset as $set) {
            $res[] = Storage::url($set['path']) . ' ' . $set['width'] . 'w';
        }

        return implode(', ', $res);
    }
}
