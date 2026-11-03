<?php

namespace App\Post\Database\Factories;

use App\Post\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(6),
            'excerpt' => fake()->text(200),
            'body' => fake()->paragraphs(5, true),
        ];
    }
}
