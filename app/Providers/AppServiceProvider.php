<?php

namespace App\Providers;

use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isUser;
use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app['router']->aliasMiddleware('is.admin', isAdmin::class);
        $this->app['router']->aliasMiddleware('is.user', isUser::class);
    }
}
