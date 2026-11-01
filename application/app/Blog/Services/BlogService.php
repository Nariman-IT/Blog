<?php 

namespace App\Blog\Services;

use App\Blog\DTO\CommentDto;
use App\Blog\Exceptions\CommentDeletionForbiddenException;
use App\Blog\Exceptions\CommentNotFoundException;
use App\Blog\Models\Comment;
use App\Blog\Repositories\BlogRepository;
use App\Post\Exceptions\PostNotFoundException;
use App\Post\Models\Post;
use App\User\Enums\UserRole;
use App\User\Enums\UserStatus;
use App\User\Exceptions\UserBannedException;
use App\User\Exceptions\UserNotFoundException;
use App\User\Models\User;
use Illuminate\Pagination\CursorPaginator;

class BlogService
{
    public function __construct(
        private readonly BlogRepository $repository
    ) {}

    public function createComment(User $user, int $id, CommentDto $dto): Comment
    {
        $post = $this->repository->getPost($id);

        if (! $post) {
            throw new PostNotFoundException();
        }

        if ($user->status === UserStatus::Banned->value) {
            throw new UserBannedException();
        }

        return $this->repository->create($user->id, $post->id, $dto);
    }

    public function deleteComment(User $user, int $id, int $commentId): void
    {
        $post = $this->repository->getPost($id);

        if (! $post) {
            throw new PostNotFoundException();
        }

        $comment = $this->repository->getComment($commentId);

        if (! $comment) {
            throw new CommentNotFoundException();
        }

        if ($user->role === UserRole::User->value) {
           throw new CommentDeletionForbiddenException();
        }

        if ($user->id !== $post->user_id) {
            throw new CommentDeletionForbiddenException();
        }

        $comment->delete();
    }

    public function showPost(int $id): Post
    {
        $post = $this->repository->getPost($id);

        if (! $post) {
            throw new PostNotFoundException();
        }

        return $post;
    }

    public function getPosts(int $id): CursorPaginator
    {
        $user = $this->repository->getUser($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return Post::where('user_id', $user->id)->latest()->cursorPaginate(10);
    }
}