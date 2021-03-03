<?php


namespace App\Ivgpu;


use App\Http\Middleware\EncryptCookies;
use App\Ivgpu\Interfaces\TokenProvider;
use App\Ivgpu\Services\ApiService;
use App\Ivgpu\Services\CookieTokenProvider;
use App\Ivgpu\Services\JwtService;
use App\Ivgpu\Services\TokenService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class IvgpuServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->resolving(EncryptCookies::class, function (EncryptCookies $middleware) {
            $middleware->disableFor(config('ivgpu.cookie.name'));
        });

        $this->app->bind(TokenProvider::class, function (Application $app) {
            $request = $app->make(Request::class);
            $cookie_name = $app['config']['ivgpu.cookie.name'];

            return new CookieTokenProvider($request, $cookie_name);
        });

        $this->app->bind(JwtService::class, function (Application $app) {
            $public_key = $app['config']['ivgpu.jwt.public_key'];

            return new JwtService($public_key);
        });

        $this->app->bind(ApiService::class, function (Application $app) {
            $client_url = $app['config']['ivgpu.client.url'];
            $client_id = $app['config']['ivgpu.client.id'];
            $client_secret = $app['config']['ivgpu.client.secret'];

            return new ApiService($client_url, $client_id, $client_secret);
        });
    }

    public function boot()
    {
        Auth::extend('ivgpu', function ($app) {
            $token = $app->make(TokenService::class);
            $provider = $app->make(TokenProvider::class);

            return new IvgpuGuard($token, $provider);
        });
    }
}
