@extends('layouts.master')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Category</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Category Detail</h6>
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
                        <td>Category Code</td>
                        <td>{{ $item->category_code }}</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>{{ $item->name }}</td>
                    </tr>
                    <tr>
                        <td>Parent Category</td>
                        <td>{{ $item->parent_category->name ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection