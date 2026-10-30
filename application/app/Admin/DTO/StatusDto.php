<?php

namespace App\Admin\DTO;

final readonly class StatusDto
{
    public function __construct(
        public string $status,
    ) {}
}