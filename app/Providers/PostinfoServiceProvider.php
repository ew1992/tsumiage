<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PostinfoService;

class PostinfoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PostinfoService::class, PostinfoService::class);
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
