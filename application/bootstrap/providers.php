<?php

use App\User\Providers\UserServiceProvider;
use App\Auth\Providers\AuthServiceProvider;
use App\Admin\Providers\AdminServiceProvider;

return [
    UserServiceProvider::class,
    AuthServiceProvider::class,
    AdminServiceProvider::class,
];
