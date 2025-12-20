<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
        ['name' => 'sport'],
        ['name' => 'food'],
        ['name' => 'travel'],
        ['name' => 'riding hourses'],
        ];
        Category::insert($categories);

    }
}
