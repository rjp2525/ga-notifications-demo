<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Patricia Griffin',
            'email' => 'patricia@example.com',
        ]);

        User::factory()->create([
            'name' => 'Jerry Royce',
            'email' => 'jerry@example.com',
        ]);

        User::factory()->admin()->create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
        ]);
    }
}
