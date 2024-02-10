<?php

namespace Database\Seeders;

use App\Models\Policy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['about', 'refend', 'terms', 'how to buy', 'contact', 'complain'];

        foreach ($types as $type) {
            Policy::create([
                'des' => '<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</strong></p>',
                'type' => $type,
            ]);
        }
    }
}

