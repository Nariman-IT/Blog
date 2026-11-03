<?php

namespace App\Blog\Database\Factories;

use App\Blog\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'body' => fake()->sentence(),
        ];
    }
}
