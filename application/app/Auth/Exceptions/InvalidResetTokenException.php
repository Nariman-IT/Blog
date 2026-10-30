<?php

namespace App\Auth\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class InvalidResetTokenException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => 'Invalid or expired reset token.',
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}