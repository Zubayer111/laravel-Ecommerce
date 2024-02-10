<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PagesSeeder;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(PagesSeeder::class);
        //$this->call(ProductsSeeder::class);
        $this->call(ProductsSliderSeeder::class);
    }
}

