<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Product First',
                'product_code' => Str::getNextAutoNumber('Product'),
            ],
            [
                'name' => 'Product Second',
                'product_code' => Str::getNextAutoNumber('Product'),
            ],
            [
                'name' => 'Product Third',
                'product_code' => Str::getNextAutoNumber('Product'),
            ],
            [
                'name' => 'Product Fourth',
                'product_code' => Str::getNextAutoNumber('Product'),
            ],
            [
                'name' => 'Product Fifth',
                'product_code' => Str::getNextAutoNumber('Product'),
            ],
            [
                'name' => 'Product Sixth',
                'product_code' => Str::getNextAutoNumber('Product'),
            ],
            [
                'name' => 'Product Seventh',
                'product_code' => Str::getNextAutoNumber('Product'),
            ],
            [
                'name' => 'Product Eigth',
                'product_code' => Str::getNextAutoNumber('Product'),
            ],
        ];
        foreach ($products as $product) {
            if (Product::where('name', $product['name'])->count() <= 0) {
                $product = Product::create($product);
                $categories = Category::inRandomOrder()->take(rand(1, 3))->pluck('id');
                $product->categories()->sync($categories);
            }
        }
    }
}
