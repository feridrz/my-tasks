<?php

namespace App\Providers;

use App\Services\FavoriteService;
use App\Services\ImageService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserService::class, function ($app) {
            return new UserService();
        });
        $this->app->bind(ProductService::class, function ($app) {
            return new ProductService();
        });
        $this->app->bind(ImageService::class, function ($app) {
            return new ImageService();
        });

    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
