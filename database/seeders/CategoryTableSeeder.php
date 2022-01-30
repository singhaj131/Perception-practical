<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Category First',
                'category_code' => Str::getNextAutoNumber('Category'),
            ],
            [
                'name' => 'Category Second',
                'category_code' => Str::getNextAutoNumber('Category'),
            ],
            [
                'name' => 'Category Third',
                'category_code' => Str::getNextAutoNumber('Category'),
            ],
            [
                'name' => 'Category Fourth',
                'category_code' => Str::getNextAutoNumber('Category'),
            ],
            [
                'name' => 'Category Fifth',
                'category_code' => Str::getNextAutoNumber('Category'),
            ],
            [
                'name' => 'Category Sixth',
                'category_code' => Str::getNextAutoNumber('Category'),
            ],
            [
                'name' => 'Category Seventh',
                'category_code' => Str::getNextAutoNumber('Category'),
            ],
            [
                'name' => 'Category Eigth',
                'category_code' => Str::getNextAutoNumber('Category'),
            ]
        ];
        foreach ($categories as $category) {
            if (Category::where('name', $category['name'])->count() <= 0) {
                Category::create($category);
            }
        }
    }
}
