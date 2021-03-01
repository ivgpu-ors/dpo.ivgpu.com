<?php

return [
    'user' => env('SBER_USER'),
    'pass' => env('SBER_PASS'),
    'return_url' => '/order/success',
    'fail_url' => '/order/fail'
];
