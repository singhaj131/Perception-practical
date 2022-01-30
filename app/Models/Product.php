<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['product_code', 'name', 'image'];

    public function setProductCodeAttribute()
    {
        $this->attributes['product_code'] = Str::getNextAutoNumber('Product');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image != null) {
            return '/uploads/products/' . $this->image;
        }
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category')->withTimestamps();
    }
}
