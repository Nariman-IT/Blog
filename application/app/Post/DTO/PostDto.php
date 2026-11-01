<?php

namespace App\Post\DTO;

final readonly class PostDto
{
    public function __construct(
        public string $title,
        public string $excerpt,
        public string $body,
        public int $categories,
    ) {}
}