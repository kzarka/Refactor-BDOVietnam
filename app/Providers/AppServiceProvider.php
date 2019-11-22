<?php

namespace App\Providers;

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
        $this->app->bind(\App\Services\Contracts\GameServiceInterface::class, \App\Services\Game\GameService::class);
        $this->app->bind(\App\Services\Contracts\CategoryServiceInterface::class, \App\Services\Category\CategoryService::class);
        $this->app->bind(\App\Services\Contracts\PostServiceInterface::class, \App\Services\Post\PostService::class);
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
