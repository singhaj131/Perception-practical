<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Traits\ImageTrait;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    use ImageTrait;
    public $dir = '/uploads/products';

    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function store($request)
    {
        $request->merge(['product_code' => $request->name]);
        if ($request->hasFile('product_image')) {
            $data['image'] = $this->uploadImage($this->dir, 'product_image');
            $request->merge(['image' => $data['image']]);
        }
        $product = $this->model->create($request->except('_token'));
        $product->categories()->attach($request->category_id);
        return $product;
    }

    public function update($request, $id)
    {
        $product = $this->model->findOrFail($id);
        if (!isset($request->old_image) && $product->image != null) {
            $this->removeImage($this->dir, $product->image);
            $data['image'] = null;
        }
        if ($request->hasFile('product_image')) {
            $this->removeImage($this->dir, $product->image);
            $data['image'] = $this->uploadImage($this->dir, 'product_image');
            $request->merge(['image' => $data['image']]);
        }
        $data = $request->except('_token');
        $product->fill($data)->save();
        $product = $this->model->find($id);
        $product->categories()->sync($request->category_id);
        return $product;
    }

    public function getSingleItem($id)
    {
        $record =  $this->query()->with('categories')->withTrashed()->where('id', $id)->firstOrFail();
        return $record;
    }

    public function deletePermanently($id)
    {
        $record =  $this->query()->withTrashed()->where('id', $id)->firstOrFail();
        $productImage = $record->image;
        $record->forceDelete();
        $this->removeImage($this->dir, $productImage);
    }
}
