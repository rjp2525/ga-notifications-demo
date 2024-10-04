<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    public function definition(): array
    {
        $title = (string) fake()->words(rand(5, 15), true);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => fake()->paragraphs(3, true),
            'user_id' => User::factory()->admin(),
        ];
    }
}
