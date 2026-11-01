<?php

namespace App\Post\Http\Controllers;

use App\Post\DTO\PostDto;
use App\Post\Http\Requests\PostRequest;
use App\Post\Resources\PostCollection;
use App\Post\Resources\PostResource;
use App\Post\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController
{
    public function index(Request $request): JsonResponse
    {
        $posts = $request->user()->posts()->latest('id')->cursorPaginate(10);
        
        return response()->json([
            'posts' => new PostCollection($posts),
        ], Response::HTTP_OK);
    }

    public function store(PostRequest $request, PostService $service): JsonResponse
    {
        $dto = new PostDto(...$request->validated());
        $post = $service->storePost($request->user(), $dto);

        return response()->json([
            'post' => new PostResource($post),
        ], Response::HTTP_CREATED);
    }

    public function update(PostRequest $request, int $id, PostService $service): JsonResponse
    {
        $dto = new PostDto(...$request->validated());
        $post = $service->updatePost($request->user(), $dto, $id);

        return response()->json([
            'post' => new PostResource($post),
        ], Response::HTTP_OK);
    }

    public  function delete(Request $request, int $id, PostService $service): JsonResponse 
    {
        $service->delete($request->user(), $id);

        return response()->json([
            'message' => 'Post deleted successfully.',
        ], Response::HTTP_OK);
    }
}



