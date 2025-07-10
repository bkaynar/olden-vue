<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->text(),
            'provider_id' => fake()->text(),
            'game_server_url' => fake()->text(),
            'game_id' => fake()->text(),
            'game_name' => fake()->name(),
            'game_code' => fake()->text(),
            'game_type' => fake()->text(),
            'description' => fake()->text(),
            'cover' => fake()->text(),
            'status' => fake()->text(),
            'technology' => fake()->text(),
            'has_lobby' => fake()->text(),
            'is_mobile' => fake()->text(),
            'has_freespins' => fake()->text(),
            'has_tables' => fake()->text(),
            'only_demo' => fake()->text(),
            'rtp' => $this->faker->numberBetween(1, 1000),
            'distribution' => fake()->text(),
            'views' => $this->faker->numberBetween(1, 1000),
            'is_featured' => fake()->text(),
            'show_home' => fake()->text(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'ikincilmi' => fake()->text(),
            'url' => fake()->text(),
            'turnuva' => fake()->text(),
            'jackpot' => fake()->text(),
            'freespin' => fake()->text(),
            'drop' => fake()->text(),
            'populer' => fake()->text(),
            'eniyi' => fake()->text(),
            'megaways' => fake()->text(),
            'demolink' => fake()->text(),
        ];
    }
}
