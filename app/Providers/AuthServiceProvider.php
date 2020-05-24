<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('can-view-user-list', function($user) {
            return $user->hasUserRole(['admin', 'libr']);
        });

        Gate::define('can-edit-user', function($user) {
            return $user->hasUserRole(['admin']);
        });

        Gate::define('can-delete-user', function($user) {
            return $user->hasUserRole(['admin']);
        });

        Passport::routes();
    }
}
