<?php

namespace App\Admin\DTO;

final readonly class CategoryDto
{
    public function __construct(
        public string $category,
    ) {}
}