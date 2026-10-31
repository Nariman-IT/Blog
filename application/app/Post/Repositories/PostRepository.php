<?php 

namespace App\Post\Repositories;

use App\Post\DTO\PostDto;
use App\Post\Models\Post;


class PostRepository
{
    public function createPost(int $id, PostDto $dto): Post
    {
        return Post::create(
            [
                'user_id' => $id,
                'title' => $dto->title,
                'excerpt' => $dto->excerpt,
                'body' => $dto->body,
                'categories' => $dto->categories,
            ]
        );
    }

    public function getUserPost(int $id): ?Post
    {
        return Post::where('user_id', $id)->first();
    }

    public function getPost(int $id): ?Post 
    {
        return Post::where('id', $id)->first();
    }
}