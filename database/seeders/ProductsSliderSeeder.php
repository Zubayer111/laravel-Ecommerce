<?php

namespace Database\Seeders;

use App\Models\ProductSlider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductSlider::factory(10)->create();
    }
}
