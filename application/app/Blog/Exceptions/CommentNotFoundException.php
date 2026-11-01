<?php

namespace App\Blog\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CommentNotFoundException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => 'Comment not found.',
        ], Response::HTTP_NOT_FOUND);
    }
}
