<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppRepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\Contracts\GameRepositoryInterface::class, \App\Repositories\GameRepository::class);
        $this->app->bind(\App\Repositories\Contracts\CategoryRepositoryInterface::class, \App\Repositories\CategoryRepository::class);
        $this->app->bind(\App\Repositories\Contracts\PostRepositoryInterface::class, \App\Repositories\PostRepository::class);
        $this->app->bind(\App\Repositories\Contracts\UserRepositoryInterface::class, \App\Repositories\UserRepository::class);
        $this->app->bind(\App\Repositories\Contracts\CommentRepositoryInterface::class, \App\Repositories\CommentRepository::class);
        $this->app->bind(\App\Repositories\Contracts\TagRepositoryInterface::class, \App\Repositories\TagRepository::class);

        $this->app->bind(\App\Repositories\Contracts\Log\ActivityLogRepositoryInterface::class, \App\Repositories\Log\ActivityLogRepository::class);
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
