<?php

namespace App\User\Database\Seeders;

use App\User\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'IrfanAdmin',
            'email' => 'irfanadmin@email.com',
            'password' => '123123123i',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Irfan',
            'email' => 'irfan@email.com',
            'password' => '123123123i',
            'role' => 'author',
        ]);
        
        User::factory()->count(10)->create();
    }
}
