<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Auth\AdminGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        Auth::extend('admin', function ($app, $name, array $config) {

            $guard = new AdminGuard($app->make('request'));

            $guard->setRequest($this->app->refresh('request', $guard, 'setRequest'));

            return $guard;
        });        
    }
}
