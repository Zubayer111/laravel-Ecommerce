<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductDetail>
 */
class ProductDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //$imageUrl = imageUrl('https://photo.teamrabbil.com/images/2023/04/04/product.png');
        return [
            'img1' => $this->faker->imageUrl('https://photo.teamrabbil.com/images/2023/04/04/product.png'),
            'img2' => $this->faker->imageUrl('https://photo.teamrabbil.com/images/2023/04/04/product.png'),
            'img3' => $this->faker->imageUrl('https://photo.teamrabbil.com/images/2023/04/04/product.png'),
            'img4' => $this->faker->imageUrl('https://photo.teamrabbil.com/images/2023/04/04/product.png'),
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'color' => $this->faker->colorName,
            'des' => $this->faker->paragraph,
            'product_id' => $this->faker->randomElement([3, 5, 11, 15, 30, 2]),
        ];
    }
}
