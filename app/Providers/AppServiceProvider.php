<?php

namespace App\Providers;

use Acme\Application\DataAccess\Database\GatewayInterface;
use Acme\Application\Repositories\UserRepository;
use Acme\Domain\Repositories\UserRepositoryInterface;
use App\DataAccess\Database\Gateway;
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
        $this->app->bind(GatewayInterface::class, function ($app) {
            return new Gateway($app->make(Connection::class));
        });

        $this->app->bind(UserRepositoryInterface::class, function ($app) {
            return new UserRepository($app->make(GatewayInterface::class));
        });
    }
}
