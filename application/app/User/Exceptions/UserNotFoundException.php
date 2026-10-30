<?php

namespace App\User\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserNotFoundException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => 'User not found.',
        ], Response::HTTP_NOT_FOUND);
    }
}