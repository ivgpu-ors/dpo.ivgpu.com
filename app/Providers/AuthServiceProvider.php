<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function (User $user) {
            return in_array('DPO_ADMIN', $user->roles);
        });

        Gate::define('study', function (User $user) {
            return in_array('DPO_MEMBER', $user->roles);
        });

        Gate::define('view-order', function (User $user, Order $order) {
            return $order->user_id === $user->id;
        });
    }
}
