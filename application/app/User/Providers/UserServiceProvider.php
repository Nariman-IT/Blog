<?php

namespace App\User\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(paths: __DIR__ . '/../Database/Migrations');
    }
}