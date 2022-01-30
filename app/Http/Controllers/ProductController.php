<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $items = $this->productRepository->getAllData($request, ['categories'], true, [],  false);
        return view('product.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = $this->categoryRepository->getAllData($request, [], false, ['id', 'name'], false);
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $this->productRepository->store($request);
        $request->session()->flash('success', 'Product Created Successfully');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->productRepository->getSingleItem($id);
        return view('product.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $item = $this->productRepository->find($id);
        if (!$item) {
            abort(404);
        }
        $categories = $this->categoryRepository->getAllData($request, [], false, ['id', 'name'], false);
        return view('product.edit', compact('categories', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $this->productRepository->update($request, $id);
        request()->session()->flash('success', 'Product Updated Successfully');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->productRepository->delete($request, $id);
        request()->session()->flash('success', 'Product Deleted Successfully');
        return redirect()->route('products.index');
    }

    public function restoreDeleted($id)
    {
        $this->productRepository->restoreDeleted($id);
        request()->session()->flash('success', 'Product Restored Successfully');
        return redirect()->route('products.index');
    }

    public function forceDelete($id)
    {
        $this->productRepository->deletePermanently($id);
        request()->session()->flash('success', 'Product Deleted Permanently Successfully');
        return redirect()->route('products.index');
    }
}
