<?php

namespace App\Admin\DTO;

final readonly class SearchDto
{
    public function __construct(
        public string $search,
    ) {}
}