<?php

namespace App\Admin\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CategoryNotFoundException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => 'Category not found.',
        ], Response::HTTP_NOT_FOUND);
    }
}
