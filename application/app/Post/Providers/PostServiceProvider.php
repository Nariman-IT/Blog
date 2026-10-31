<?php

namespace App\Post\Providers;

use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/post.php');
        $this->loadMigrationsFrom(paths: __DIR__ . '/../Database/Migrations');
    }
}

 