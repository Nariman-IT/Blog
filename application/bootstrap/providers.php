<?php

use App\User\Providers\UserServiceProvider;
use App\Auth\Providers\AuthServiceProvider;
use App\Admin\Providers\AdminServiceProvider;
use App\Post\Providers\PostServiceProvider;

return [
    UserServiceProvider::class,
    AuthServiceProvider::class,
    AdminServiceProvider::class,
    PostServiceProvider::class,
];
