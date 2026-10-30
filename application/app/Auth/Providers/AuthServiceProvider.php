<?php

namespace App\Auth\Providers;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/auth.php');
        $this->loadMigrationsFrom(paths: __DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(app_path('Auth/View'), 'auth');
    }
}

 