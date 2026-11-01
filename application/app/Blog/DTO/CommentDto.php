<?php

namespace App\Blog\DTO;

final readonly class CommentDto
{
    public function __construct(
        public string $body,
    ) {}
}