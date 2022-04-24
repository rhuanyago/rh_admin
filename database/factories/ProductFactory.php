<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => $this->faker->randomFloat(0, 1, 100),
            'name' => $this->faker->unique()->name(),
            'value' => $this->faker->randomFloat(3, 1, 1000),
            'able' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
