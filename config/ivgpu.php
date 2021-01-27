<?php

return [
    'cookie' => [
        'name' => 'ivgpu_auth',
    ],

    'jwt' => [
        'public_key' => env('AUTH_PUBLIC_KEY', ''),
    ],

    'client' => [
        'url' => env('AUTH_CLIENT_URL'),
        'login_path' => '/login',
        'id' => env('AUTH_CLIENT_ID'),
        'secret' => env('AUTH_CLIENT_SECRET'),
    ]
];
