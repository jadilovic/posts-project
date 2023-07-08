<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostCategory::create([
            'naziv' => 'Auta'
        ]);

        PostCategory::create([
            'naziv' => 'Bicikli'
        ]);

        PostCategory::create([
            'naziv' => 'Racunari'
        ]);

        PostCategory::create([
            'naziv' => 'Igracke'
        ]);

        PostCategory::create([
            'naziv' => 'Stanovi'
        ]);
    }
}
