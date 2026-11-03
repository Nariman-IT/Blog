<?php

namespace Database\Seeders;

use App\Admin\Database\Seeders\AdminSeeder;
use App\Blog\Database\Seeders\CommentSeeder;
use App\Post\Database\Seeders\PostSeeder;
use App\User\Database\Seeders\UserSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
        ]);
    }
}
