<?php

namespace App\Providers;

use App\Services\OrderService;
use Illuminate\Support\ServiceProvider;
use Voronkovich\SberbankAcquiring\Client;
use Voronkovich\SberbankAcquiring\Currency;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind(OrderService::class, function() {
            $client = new Client([
                'userName' => config('sber.user'),
                'password' => config('sber.pass'),
                'currency' => Currency::RUB,
            ]);

            return new OrderService($client, config('sber.return_url'), config('sber.fail_url'));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        //
    }
}
