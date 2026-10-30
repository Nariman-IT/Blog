<?php

namespace App\Auth\Http\Controllers;

use App\Auth\Http\Requests\ForgotPasswordRequest;
use App\Auth\Services\AuthService;
use Illuminate\Http\JsonResponse;
use App\Auth\DTO\ForgotPasswordDto;
use Symfony\Component\HttpFoundation\Response;

class ForgotPasswordController
{
    public function send(ForgotPasswordRequest $request, AuthService $service): JsonResponse
    {
        $dto = new ForgotPasswordDto(...$request->validated());
        $service->sendResetLink($dto);

        return response()->json([
            'message' => 'If this email exists, a reset link has been sent.',
        ], Response::HTTP_OK);
    }
}
