<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
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
        $title = ucwords(fake()->sentence(nbWords: 5));
        $slug = Str::of($title)->slug('-');

        return [
            'category_id' => fake()->numberBetween(1, 10),
            'user_id' => fake()->numberBetween(1, 10),
            'title' => $title,
            'slug' => $slug,
            'body' => fake()->paragraph(nbSentences: 10),
        ];
    }
}