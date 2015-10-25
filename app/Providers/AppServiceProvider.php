<?php

namespace App\Providers;

use App\Library\Auth\AppGuard;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Auth::extend('key', function()
        {
            $model = $this->app['config']['auth.model'];
            $provider = new EloquentUserProvider($this->app['hash'], $model);
            return new AppGuard($provider, $this->app['session.store']);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
