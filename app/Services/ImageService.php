<?php


namespace App\Services;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService
{
    /**
     * @var integer[]
     */
    private array $srcset;
    private string $root;

    /**
     * ImageService constructor.
     * @param integer[] $srcset
     */
    public function __construct(array $srcset)
    {
        $this->srcset = $srcset;
        $this->root = Storage::disk('public')->path('');
    }

    public function makeSet($path): array
    {
        $set = [];

        foreach ($this->srcset as $width) {
            if ($width_file = $this->copyToWidth($path, $width)) {
                $set[] = [
                    'width' => $width,
                    'path' => $width_file,
                ];
            }
        }

        return $set;
    }

    public function copyToWidth($path, int $width): ?string
    {
        $img = Image::make($this->root . $path);
        if ($img->width() < $width) {
            return null;
        }

        $img->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        [ 'dirname' => $dir, 'extension' => $ext, 'filename' => $filename ] = pathinfo($path);
        $file_path  = "$dir/$filename@$width.$ext";
        $img->save($this->root . $file_path);

        return $file_path;
    }
}
