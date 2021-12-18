<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helper\JsonDatabase;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(JsonDatabase::class);
    }
}
