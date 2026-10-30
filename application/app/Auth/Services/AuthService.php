<?php 

namespace App\Auth\Services;

use App\Auth\DTO\ForgotPasswordDto;
use App\Auth\DTO\LoginDto;
use App\Auth\DTO\RegisterDto;
use App\Auth\DTO\ResetPasswordDto;
use App\Auth\Exceptions\InvalidCredentialsException;
use App\Auth\Exceptions\InvalidResetTokenException;
use App\Auth\Repositories\AuthRepository;
use App\Auth\Mail\ResetPasswordMail;
use App\User\Exceptions\UserNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class AuthService
{
    public function __construct(
        private readonly AuthRepository $repository
    ) {}

    public function register(RegisterDto $dto): array
    {
        $user = $this->repository->create($dto);
        $token = $user->createToken('auth_token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }

    public function login(LoginDto $dto): array
    {
        $user = $this->repository->findByEmail($dto->email); 

        if (!$user || !Hash::check($dto->password, $user->password)) {
            throw new InvalidCredentialsException();
        }

        $user->tokens()->where('name', 'auth_token')->delete();
        $token = $user->createToken('auth_token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }

    public function sendResetLink(ForgotPasswordDto $dto): void
    {
        $user = $this->repository->findByEmail($dto->email);

        if (!$user) {
            return;
        }

        $token = Str::random(64);
        $this->repository->createResetToken($dto->email, Hash::make($token));

        $resetUrl = config('app.url') . '/api/v1/auth/reset-password?token=' . $token . '&email=' . urlencode($dto->email);

        Mail::to($user)->send(new ResetPasswordMail($resetUrl, $user->name));
    }

    public function reset(ResetPasswordDto $dto)
    {
        $record = $this->repository->findResetTokenByEmail($dto->email);

        if (! $record) {
            throw new InvalidResetTokenException();
        }

        if ($record->created_at < now()->subMinutes(60)) {
            $this->repository->deleteResetTokenByEmail($dto->email);
            throw new InvalidResetTokenException();
        }

        if (! Hash::check($dto->token, $record->token)) {
            throw new InvalidResetTokenException();
        }

        $user = $this->repository->findByEmail($dto->email);

        if (! $user) {
            throw new UserNotFoundException();
        }

        $user->password = $dto->password;
        $user->save();

        $this->repository->deleteResetTokenByEmail($user->email);
    }
}