<?php 

namespace App\Admin\Services;

use App\Admin\DTO\RoleDto;
use App\Admin\DTO\SearchDto;
use App\Admin\DTO\StatusDto;
use App\Admin\Exceptions\AdminForbiddenException;
use App\Admin\Repositories\AdminRepository;
use App\User\Enums\UserRole;
use App\User\Exceptions\UserNotFoundException;
use App\User\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\CursorPaginator;

class AdminService
{
    public function __construct(
        private readonly AdminRepository $repository
    ) {}

    public function getUsers(string|null $role): CursorPaginator
    {
        if (! $role) {
            $users = $this->repository->paginate();
        }

        if ($role) {
            $users = $this->repository->paginateByRole($role);
        }

        return $users;
    }

    public function updateRole(int $id, RoleDto $dto): User
    {
        $user = $this->repository->getUserById($id);

        if (! $user) {
            throw new UserNotFoundException();
        }

        $this->isAdmin($user);

        if ($user->role === $dto->role) {
            return $user;
        }

        $user->role = $dto->role;
        $user->save();

        return $user;
    }

    public function updateStatus(int $id, StatusDto $dto): User
    {
        $user = $this->repository->getUserById($id);

        if (! $user) {
            throw new UserNotFoundException();
        }

        $this->isAdmin($user);

        if ($user->status === $dto->status) {
            return $user;
        }

        $user->status = $dto->status;
        $user->save();

        return $user;
    }

    public function delete(int $id): void
    {
        $user = $this->repository->getUserById($id);

        if (! $user) {
            throw new UserNotFoundException();
        }
        
        $this->isAdmin($user);

        $user->delete();
    }

    public function searchUser(SearchDto $dto): Collection
    {
        $user = $this->repository->getUserByEmail($dto->search);

        if (! $user) {
            $user = $this->repository->getUserByName($dto->search);
        }

        if (! $user ) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    private function isAdmin(User $user): void
    {
        if ($user->role === UserRole::Admin->value) {
            throw new AdminForbiddenException();
        }
    }

   
}