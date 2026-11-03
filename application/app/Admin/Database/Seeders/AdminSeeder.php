<?php

namespace App\Admin\Database\Seeders;

use App\Admin\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Category::factory()->count(8)->create();
    }
}
