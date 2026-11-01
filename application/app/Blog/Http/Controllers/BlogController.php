<?php

namespace App\Blog\Http\Controllers;

use App\Blog\DTO\CommentDto;
use App\Blog\Http\Requests\CommentRequest;
use App\Blog\Resources\CommentCollection;
use App\Blog\Resources\CommentResource;
use App\Blog\Resources\PostCommentCollection;
use App\Blog\Resources\PostCommentResource;
use App\Blog\Services\BlogService;
use App\Post\Models\Post;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class BlogController
{
    public function main(BlogService $service): JsonResponse
    {
        $posts = Post::latest()->cursorPaginate(10);

        return response()->json([
            'posts' => new PostCommentCollection($posts),
        ], Response::HTTP_OK);
    }

    public function index(int $id, BlogService $service): JsonResponse
    {
        $posts = $service->getPosts($id);
        
        return response()->json([
            'posts' => new PostCommentCollection($posts),
        ], Response::HTTP_OK);
    }

    public function show(int $id, BlogService $service): JsonResponse
    {
        $post = $service->showPost($id);
        $comments = $post->comments()->latest()->cursorPaginate(10);

        return response()->json([
            'post' => new PostCommentResource($post),
            'comments' => new CommentCollection($comments),
        ], Response::HTTP_OK);
    }

    public function comment(CommentRequest $request, int $id, BlogService $service): JsonResponse
    {
        $dto = new CommentDto(...$request->validated());
        $comment = $service->createComment($request->user(), $id, $dto);

        return response()->json([
            'comment' => new CommentResource($comment),
        ], Response::HTTP_CREATED);
    }

    public function delete(Request $request, int $id, int $commentId, BlogService $service): JsonResponse
    {
        $service->deleteComment($request->user(), $id, $commentId);

        return response()->json([
            'message' => 'Comment deleted successfully.',
        ], Response::HTTP_OK);
    }

    public function categories()
    {
        // На главной странице у каждой статьи отображается категория.
        // При клике на категорию выводится список всех статей этой категории.
    }
}
