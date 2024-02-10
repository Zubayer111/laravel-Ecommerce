<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductSlider>
 */
class ProductSliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'short_dse' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'image' => $this->faker->imageUrl(),
            'product_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 11, 13, 15, 16, 30]),
        ];
    }
}
