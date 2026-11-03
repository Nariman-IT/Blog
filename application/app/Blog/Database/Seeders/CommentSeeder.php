<?php

namespace App\Blog\Database\Seeders;

use App\Blog\Models\Comment;
use App\Post\Models\Post;
use App\User\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {        
        $userIds = User::pluck('id');
        $postIds = Post::pluck('id');

        Comment::factory()->count(1000)->create(function () use ($userIds, $postIds) {
            return [
                'user_id' => $userIds->random(),
                'post_id' => $postIds->random(),
            ];
        });
    }
}
