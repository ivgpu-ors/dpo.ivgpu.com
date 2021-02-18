<?php

namespace App\Providers;

use App\Services\ImageService;
use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind('img', fn() => new ImageService(config('media.images.srcset')));
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        //
    }
}
