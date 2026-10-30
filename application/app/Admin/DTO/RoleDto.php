<?php

namespace App\Admin\DTO;

final readonly class RoleDto
{
    public function __construct(
        public string $role,
    ) {}
}