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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin',function ($user){
            if ($user->tipo_user=='superadmin' || $user->tipo_user=='admin') {
                return true;
            }
            else{
                return false;
            }
        });

        Gate::define('professor',function ($user){
            if ($user->tipo_user=='professor') {
                return true;
            }
            else{
                return false;
            }
        });
        
    }
}
