<?php

namespace App\Auth\Http\Controllers;

use App\Auth\DTO\LoginDto;
use App\Auth\DTO\RegisterDto;
use App\Auth\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Auth\Http\Requests\RegisterRequest;
use App\Auth\Http\Requests\LoginRequest;
use App\User\Resources\UserResource;

class AuthController
{
    public function register(RegisterRequest $request, AuthService $service): JsonResponse
    {
        $dto = new RegisterDto(...$request->validated());
        $result = $service->register($dto);

        return response()->json([
            'user' => new UserResource($result['user']),
            'token' => $result['token'],
            'token_type' => 'Bearer'
        ], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request, AuthService $service): JsonResponse
    {
        $dto = new LoginDto(...$request->validated());
        $result = $service->login($dto);

        return response()->json([
            'user' => new UserResource($result['user']),
            'token' => $result['token'],
            'token_type' => 'Bearer'
        ], Response::HTTP_OK);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ], Response::HTTP_OK);
    }
}
