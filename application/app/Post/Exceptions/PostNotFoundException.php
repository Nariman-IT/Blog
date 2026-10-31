<?php

namespace App\Post\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PostNotFoundException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => 'Post not found.',
        ], Response::HTTP_NOT_FOUND);
    }
}
