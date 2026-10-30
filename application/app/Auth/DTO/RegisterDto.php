<?php

namespace App\Auth\DTO;

final readonly class RegisterDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {}
}