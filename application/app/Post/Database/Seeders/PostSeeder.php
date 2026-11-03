<?php

namespace App\Post\Database\Seeders;

use App\Admin\Models\Category;
use App\Post\Models\Post;
use App\User\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::where('email', 'irfanadmin@email.com')->first();
        $categoryIds = Category::pluck('id');

        Post::factory()->count(50)->create(function () use ($author, $categoryIds) {
            return [
                'user_id' => $author->id,
                'category_id' => $categoryIds->random(),
            ];
        });
    }
}
