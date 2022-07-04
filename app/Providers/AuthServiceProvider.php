<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        //if admin
        Gate::define('is-admin', function($user) {
            return $user->hasRole('administrateur');
        });

        //if manager
        Gate::define('is-manager', function($user) {
            return $user->hasAnyRoles(['administrateur', 'éditeur']);
        });
    }
}
