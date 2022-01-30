@extends('layouts.master')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Product</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Product Detail</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="20%">Field Name</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Product Code</td>
                        <td>{{ $item->product_code }}</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>{{ $item->name }}</td>
                    </tr>
                    <tr>
                        <td>Categories</td>
                        <td>
                            @foreach ($item->categories as $category)
                            <span class="badge badge-info">{{ $category->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td><img src="{{ $item->image_url }}" alt="" style="max-height: 100px"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection