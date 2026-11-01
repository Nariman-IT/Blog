<?php

namespace App\Admin\Http\Controllers;

use App\Admin\DTO\CategoryDto;
use App\Admin\DTO\RoleDto;
use App\Admin\DTO\SearchDto;
use App\Admin\DTO\StatusDto;
use App\Admin\Http\Requests\CategoryRequest;
use App\Admin\Http\Requests\RoleRequest;
use App\Admin\Http\Requests\SearchRequest;
use App\Admin\Http\Requests\StatusRequest;
use App\Admin\Resources\AdministratorsPersonalAccountCollection;
use App\Admin\Resources\AuthorsCollection;
use App\Admin\Resources\CategoryResource;
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
            'users' => new AdministratorsPersonalAccountCollection($users),
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

    public function authors(AdminService $service): JsonResponse
    {
        $authors = $service->getAuthors();

        return response()->json([
            'authors' => new AuthorsCollection($authors),
        ], Response::HTTP_OK);
    }

    public function create(CategoryRequest $request, AdminService $service): JsonResponse
    {
        $dto = new CategoryDto(...$request->validated());
        $category = $service->createCategory($dto);

        return response()->json([
            'category' => new CategoryResource($category),
        ], Response::HTTP_CREATED);
    }

    public function update(CategoryRequest $request, int $id, AdminService $service): JsonResponse
    {
        $dto = new CategoryDto(...$request->validated());
        $category = $service->updateCategory($id, $dto);

        return response()->json([
            'category' => new CategoryResource($category),
        ], Response::HTTP_OK);
    }

    public function deleteCategories(int $id, AdminService $service): JsonResponse
    {
        $service->deleteCategory($id);

        return response()->json([
            'message' => 'Category deleted successfully.',
        ], Response::HTTP_OK);
    }
}
