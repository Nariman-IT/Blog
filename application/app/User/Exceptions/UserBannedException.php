<?php

namespace App\User\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserBannedException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => 'Your account has been banned.',
        ], Response::HTTP_FORBIDDEN);
    }
}