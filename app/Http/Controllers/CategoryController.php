<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private ProductRepositoryInterface $productRepository;
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = $this->categoryRepository->getAllData($request, ['parent_category'], true, [], false);
        return view('category.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $parentCategories = $this->categoryRepository->getParentCategory();
        return view('category.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryRepository->store($request);
        request()->session()->flash('success', 'Category Created Successfully');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->categoryRepository->getSingleItem($id);
        return view('category.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->categoryRepository->find($id);
        $parentCategories = $this->categoryRepository->getParentCategory();
        return view('category.edit', compact('parentCategories', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->categoryRepository->update($request, $id);
        request()->session()->flash('success', 'Category Updated Successfully');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->categoryRepository->delete($request, $id);
        request()->session()->flash('success', 'Category Deleted Successfully');
        return redirect()->route('categories.index');
    }

    public function restoreDeleted($id)
    {
        $this->categoryRepository->restoreDeleted($id);
        request()->session()->flash('success', 'Category Restored Successfully');
        return redirect()->route('categories.index');
    }

    public function forceDelete($id)
    {
        $this->categoryRepository->deletePermanently($id);
        request()->session()->flash('success', 'Category Deleted Permanently Successfully');
        return redirect()->route('categories.index');
    }
}
