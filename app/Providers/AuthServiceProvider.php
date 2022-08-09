<?php

namespace App\Providers;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     * In questo metodo definiamo le regole di autorizzazione
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function($user){
            return $user->hasLivello('admin');
        });

        Gate::define('isUtente',function($user){
            return $user->hasLivello('utente');
        });

        Gate::define('isStaff', function($user){
            return $user->hasLivello('staff');
        });
        Gate::define('isLoggato',function($user){
            return isset($user);
        });

    }
}
