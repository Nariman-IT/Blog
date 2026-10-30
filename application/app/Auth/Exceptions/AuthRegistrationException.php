<?php

namespace App\Auth\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthRegistrationException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => 'Could not register user. Please try again later.',
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
