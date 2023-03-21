<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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
            return $user->level === 'admin';
        });

        Gate::define('pemilik', function (User $user) {
            return $user->level === 'pemilik';
        });

        Gate::define('bendahara', function (User $user) {
            return $user->level === 'bendahara';
        });

        Gate::define('pelanggan', function (User $user) {
            return $user->level === 'pelanggan';
        });
    }
}
