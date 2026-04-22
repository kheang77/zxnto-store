<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(20),
            'price' => $this->faker->numberBetween(1, 20),
            'qty' => $this->faker->numberBetween(1, 10),
            'description' =>$this->faker->paragraph (50),  
            'created_at' => now(),
            'updated_at' => now(),
            'img' => $this->faker->sentence(20) .'.jpg',
            'cat_id' => $this->faker->numberBetween(1,5),
        ];
    }
}
