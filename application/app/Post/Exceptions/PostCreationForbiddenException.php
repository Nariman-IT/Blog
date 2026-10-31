<?php

namespace App\Post\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PostCreationForbiddenException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => 'You are not allowed to create posts.',
        ], Response::HTTP_FORBIDDEN);
    }
}
