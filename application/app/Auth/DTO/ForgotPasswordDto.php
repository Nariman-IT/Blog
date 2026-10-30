<?php

namespace App\Auth\DTO;

final readonly class ForgotPasswordDto
{
    public function __construct(
        public string $email,
    ) {}
}