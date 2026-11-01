<?php 

namespace App\Admin\Repositories;

use App\Admin\DTO\CategoryDto;
use App\Admin\Models\Category;
use App\User\Models\User;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Collection;
use PhpParser\Node\Stmt\Function_;

class AdminRepository
{
    public function paginate(int $perPage = 20): CursorPaginator
    {
        return User::select('id', 'name', 'email', 'role', 'status', 'created_at')->cursorPaginate($perPage);
    }

    public function paginateByRole(string $role, int $perPage = 20): CursorPaginator
    {
        return User::select('id', 'name', 'email', 'role', 'status', 'created_at')
            ->where('role', $role)
            ->cursorPaginate($perPage);
    }

    public function getUserById(int $id): ?User
    {
        return User::where('id', $id)->first();
    }

    public function getUserByEmail(string $email): ?Collection
    {
        return User::where('email', $email)->first();
    }

    public function getUserByName(string $name): ?Collection
    {
        return User::where('name', $name)->get();
    }

    public function create(CategoryDto $dto): Category
    {
        return Category::create([
            'category' => $dto->category,
        ]);
    }

    public function getCategory(int $id): ?Category
    {
        return Category::where('id', $id)->first();
    }
}