<?php

namespace App\Admin\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AdminForbiddenException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => 'Actions on administrators are forbidden.',
        ], Response::HTTP_FORBIDDEN);
    }
}
