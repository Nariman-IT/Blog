<?php

namespace App\Admin\Database\Factories;

use App\Admin\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
           'category' => fake()->unique()->randomElement([
                'Новости',
                'Обучение',
                'Обзор',
                'Технологии',
                'Спорт',
                'Культура',
                'Наука',
                'Путешествия',
            ]),
        ];
    }
}
