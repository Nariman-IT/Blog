<?php

namespace App\Post\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PostAccessDeniedException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => 'You are not allowed to modify this post.',
        ], Response::HTTP_FORBIDDEN);
    }
}
