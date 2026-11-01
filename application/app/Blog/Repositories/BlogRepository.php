<?php 

namespace App\Blog\Repositories;

use App\Blog\DTO\CommentDto;
use App\Blog\Models\Comment;
use App\Post\Models\Post;
use App\User\Models\User;

class BlogRepository
{
    public function getPost(int $id): ?Post
    {
        return Post::where('id', $id)->first();
    }

    public function create(int $userId, int $postId, CommentDto $dto): Comment
    {
        return Comment::create([
            'user_id' => $userId,
            'post_id' => $postId,
            'body' => $dto->body,
        ]);
    }

    public function getComment(int $id): ?Comment
    {
        return Comment::where('id', $id)->first();
    }

    public function getUser(int $id): ?User 
    {
        return User::where('id', $id)->first();
    }
}