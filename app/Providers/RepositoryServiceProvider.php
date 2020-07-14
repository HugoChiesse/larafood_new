<?php

namespace App\Providers;

use App\Models\Table;
use App\Repositories\Interfaces\{
    CategoryInterface,
    ClientInterface,
    OrderInterface,
    ProductInterface,
    TableInterface,
    TenantInterface
};
use App\Repositories\{
    CategoryRepository,
    ClientRepository,
    OrderRepository,
    ProductRepository,
    TableRepository,
    TenantRepository
};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TenantInterface::class,
            TenantRepository::class
        );

        $this->app->bind(
            CategoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            TableInterface::class,
            TableRepository::class
        );

        $this->app->bind(
            ProductInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            ClientInterface::class,
            ClientRepository::class
        );

        $this->app->bind(
            OrderInterface::class,
            OrderRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
