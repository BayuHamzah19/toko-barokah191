<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $cat = Category::create(['name' => 'Minuman']);
        Product::create([
            'name' => 'Teh Botol',
            'description' => 'Minuman segar',
            'price' => 5000,
            'category_id' => $cat->id
        ]);
    }
}
