<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->word,
            'image_url' => $this->faker->imageUrl(),
            'published_year' => $this->faker->numberBetween(1900, 2024),
            'is_showing' => $this->faker->boolean(),
            'description' => $this->faker->paragraph(),
            'created_at' => $this->faker->year,
            'updated_at' => $this->faker->year,
        ];
    }
}
