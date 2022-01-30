<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Str::macro('getNextAutoNumber', function ($modelName) {
            if ($modelName == 'Category') {
                $number = Category::withTrashed()->orderBy('id', 'DESC')->pluck('id')->first() + 1;
                $code = 'CAT-000' . $number;
            }
            if ($modelName == 'Product') {
                $number = Product::withTrashed()->orderBy('id', 'DESC')->pluck('id')->first() + 1;
                $code = 'PROD-000' . $number;
            }
            return $code;
        });
    }
}
