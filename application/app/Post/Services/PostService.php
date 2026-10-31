<?php 

namespace App\Post\Services;

use App\Post\DTO\PostDto;
use App\Post\Exceptions\PostAccessDeniedException;
use App\Post\Exceptions\PostCreationForbiddenException;
use App\Post\Exceptions\PostNotFoundException;
use App\Post\Models\Post;
use App\Post\Repositories\PostRepository;
use App\User\Enums\UserRole;
use App\User\Models\User;

class PostService
{
    public function __construct(
        private readonly PostRepository $repository
    ) {}

    public function storePost(User $user, PostDto $dto): Post
    {
        if ($user->role !== UserRole::Author->value) {
            throw new PostCreationForbiddenException();
        }

        $post = $this->repository->createPost($user->id, $dto);
        
        return $post;
    }

    public function updatePost(User $user, PostDto $dto, int $id): Post
    {
        $post = $this->repository->getUserPost($id);

        if (! $post) {
            throw new PostNotFoundException();
        }

        if ($post->user_id !== $user->id) {
            throw new PostAccessDeniedException();
        }

        $post->update([
            'title' => $dto->title,
            'excerpt' => $dto->excerpt,
            'body' => $dto->body,
            'categories' => $dto->categories,
        ]);

        return $post;
    }

    public function delete(User $user, int $id): void 
    {
        $post = $this->repository->getPost($id);

        if (! $post) {
            throw new PostNotFoundException();
        }

        if ($post->user_id !== $user->id) {
            throw new PostAccessDeniedException();
        }

        $post->delete();
    }
}