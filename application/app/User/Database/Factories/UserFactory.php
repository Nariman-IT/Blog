<?php

namespace App\User\Database\Factories;

use App\User\Enums\UserRole;
use App\User\Enums\UserStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\User\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => UserRole::User->value,
            'status' => UserStatus::Active->value,
            'author_assigned_at' => null,
        ];
    }
}
