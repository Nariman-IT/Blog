<?php

namespace App\Blog\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CommentDeletionForbiddenException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => 'You are not allowed to delete this comment.',
        ], Response::HTTP_FORBIDDEN);
    }
}
