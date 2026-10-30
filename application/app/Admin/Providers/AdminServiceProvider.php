<?php

namespace App\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/admin.php');
        $this->loadMigrationsFrom(paths: __DIR__ . '/../Database/Migrations');
    }
}

 