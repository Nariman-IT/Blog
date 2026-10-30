<?php

namespace App\Auth\DTO;

final readonly class ResetPasswordDto
{
    public function __construct(
        public string $token,
        public string $email,
        public string $password,
    ) {}
}