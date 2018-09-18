<?php

namespace App\Providers;

use Acme\Application\Repositories\UserRepository;
use Acme\Application\Repositories\UserRepositoryInterface;
use Illuminate\Database\Connection;
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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, function ($app) {
            return new UserRepository($app->make(Connection::class));
        });
    }
}
