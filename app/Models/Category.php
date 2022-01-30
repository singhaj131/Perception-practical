<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category_code', 'name', 'parent_category_id'];

    public function setCategoryCodeAttribute()
    {
        $this->attributes['category_code'] = Str::getNextAutoNumber('Category');
    }

    public function parent_category()
    {
        return $this->belongsTo($this, 'parent_category_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category')->withTimestamps();
    }
}
