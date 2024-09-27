<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => fake()->unique()->slug(),
            'user_id' => fn() => \App\Models\User::inRandomOrder()->first()?->id,
            'is_published' => true,
            'title' => fake()->unique()->sentence(),
            'body' => fake()->realText(),
            'published_at' => now()->subDays(rand(0, 30)),
        ];
    }
}
