<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

    public function getParentCategory()
    {
        return $this->model->where('parent_category_id', null)->select(['id', 'name'])->get();
    }

    public function store($attributes)
    {
        $attributes->merge(['category_code' => $attributes->name]);
        return $this->model->create($attributes->except('_token'));
    }

    public function getSingleItem($id)
    {
        $record =  $this->query()->with('parent_category')->withTrashed()->where('id', $id)->firstOrFail();
        return $record;
    }
}
