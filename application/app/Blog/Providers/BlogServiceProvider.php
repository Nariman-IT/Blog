<?php

namespace App\Blog\Providers;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/blog.php');
        $this->loadMigrationsFrom(paths: __DIR__ . '/../Database/Migrations');
    }
}

 