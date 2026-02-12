<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    return [
        // Isso diz ao Laravel: "Se eu não passar um ID, crie um novo usuário/categoria agora"
        'user_id' => \App\Models\User::factory(),
        'category_id' => \App\Models\Category::factory(),
        'title' => fake()->sentence(),
        'tag' => fake()->word(),
        'summary' => fake()->paragraph(),
        'content' => fake()->text(),
    ];
}
}
