<?php 

namespace App\Admin\Repositories;

use App\User\Models\User;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Collection;

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

}