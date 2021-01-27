<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $login_uri = config('ivgpu.client.url') . config('ivgpu.client.login_path');
            $params = http_build_query(['redirect' => $request->url()]);

            return $login_uri . '?' . $params;
        }

        return null;
    }
}
