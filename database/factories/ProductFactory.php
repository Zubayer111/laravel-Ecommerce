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
            'title' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'short_des' => $this->faker->sentence,
            'discount' => $this->faker->boolean,
            'discount_price' => $this->faker->randomFloat(2, 5, 50),
            'image' => $this->faker->imageUrl(),
            'stok' => $this->faker->boolean,
            'star' => $this->faker->randomFloat(1, 1, 5),
            'remark' => $this->faker->randomElement(['popular', 'new', 'top', 'special', 'trending', 'regelar']),
            'category_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'brand_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
        ];
    }
}
