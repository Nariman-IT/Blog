<?php 

namespace App\Auth\Repositories;

use App\Auth\DTO\RegisterDto;
use App\Auth\Exceptions\AuthRegistrationException;
use App\User\Models\User;
use Illuminate\Support\Facades\DB;

class AuthRepository
{
    public function create(RegisterDto $dto): User
    {
        DB::beginTransaction();
    
        try {
            $user = User::create([
                'name' => $dto->name,
                'email' => $dto->email,
                'password' => $dto->password,
            ]);

            DB::commit();
            return $user->refresh();;

        } catch (\Exception $e) {
            DB::rollBack();
            throw new AuthRegistrationException();
        }
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function createResetToken(string $email, string $token): void
    {
        DB::table('password_reset_tokens')->where('email', $email)->delete();
        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now(),
        ]);
    }

    public function findResetTokenByEmail(string $email)
    {
        return DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();
    }

    public function deleteResetTokenByEmail(string $email): void
    {
        DB::table('password_reset_tokens')->where('email', $email)->delete();
    }
}