<?php

namespace App\Auth\Http\Controllers;

use App\Auth\DTO\ResetPasswordDto;
use App\Auth\Http\Requests\ResetPasswordRequest;
use App\Auth\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController
{
    public function reset(ResetPasswordRequest $request, AuthService $service): JsonResponse
    {
        $dto = new ResetPasswordDto(...$request->validated());
        $service->reset($dto);

        return response()->json([
            'message' => 'Password has been reset. Please log in.',
        ], Response::HTTP_OK);
    }
}
