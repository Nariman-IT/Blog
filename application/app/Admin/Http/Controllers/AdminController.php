<?php

namespace App\Admin\Http\Controllers;

use App\Admin\DTO\RoleDto;
use App\Admin\DTO\SearchDto;
use App\Admin\DTO\StatusDto;
use App\Admin\Http\Requests\RoleRequest;
use App\Admin\Http\Requests\SearchRequest;
use App\Admin\Http\Requests\StatusRequest;
use App\Admin\Resources\SearchCollection;
use App\Admin\Resources\UserCollection;
use App\Admin\Services\AdminService;
use App\User\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AdminController
{
    public function index(Request $request, AdminService $service): JsonResponse
    {
        $role = $request->query('role', null);
        $users = $service->getUsers($role);

        return response()->json([
            'users' => new UserCollection($users),
        ], Response::HTTP_OK);
    }

    public function roles(RoleRequest $request, int $id, AdminService $service): JsonResponse
    {
        $dto = new RoleDto(...$request->validated());
        $user = $service->updateRole($id, $dto);

        return response()->json([
            'user' => new UserResource($user),
        ], Response::HTTP_OK);
    }

    public function status(StatusRequest $request, int $id, AdminService $service): JsonResponse
    {
        $dto = new StatusDto(...$request->validated());
        $user = $service->updateStatus($id, $dto);

        return response()->json([
            'user' => new UserResource($user),
        ], Response::HTTP_OK);
    }

    public function delete(int $id, AdminService $service): JsonResponse
    {
        $service->delete($id);

        return response()->json([
            'message' => 'User deleted successfully.',
        ], Response::HTTP_OK);
    }

    public function search(SearchRequest $request, AdminService $service): JsonResponse
    {
        $dto = new SearchDto(...$request->validated());
        $user = $service->searchUser($dto);

        return response()->json([
            'users' => new SearchCollection($user),
        ], Response::HTTP_OK); 
    }
}
